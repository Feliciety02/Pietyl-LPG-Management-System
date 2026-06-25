<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\User;
use App\Models\UserStat;
use Illuminate\Support\Facades\DB;

class AchievementService
{
    public function awardXp(User $user, int $amount, string $reason = ''): array
    {
        $stat = $this->getStats($user);
        $stat->xp += $amount;
        $newLevel = UserStat::levelForXp($stat->xp);
        $leveledUp = $newLevel > $stat->level;
        $stat->level = $newLevel;
        $stat->save();

        $this->checkStreak($user);

        return [
            'xp' => $amount,
            'total_xp' => $stat->xp,
            'level' => $stat->level,
            'title' => UserStat::levelTitle($stat->level),
            'leveled_up' => $leveledUp,
            'reason' => $reason,
        ];
    }

    public function getStats(User $user): UserStat
    {
        return UserStat::firstOrCreate(
            ['user_id' => $user->id],
            [
                'xp' => 0,
                'level' => 1,
                'streak' => 0,
                'last_active_date' => null,
            ]
        );
    }

    public function checkStreak(User $user): void
    {
        $stat = $this->getStats($user);
        $today = now()->startOfDay();

        if ($stat->last_active_date) {
            $yesterday = now()->subDay()->startOfDay();
            $lastActive = $stat->last_active_date->startOfDay();

            if ($lastActive->eq($today)) {
                return;
            }

            if ($lastActive->eq($yesterday)) {
                $stat->streak++;
            } else {
                $stat->streak = 1;
            }
        } else {
            $stat->streak = 1;
        }

        $stat->last_active_date = $today;
        $stat->save();
    }

    public function checkAchievements(User $user): array
    {
        $unlocked = [];
        $stats = $this->getStats($user);
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            $pivot = $user->achievements()
                ->where('achievement_id', $achievement->id)
                ->first();

            if ($pivot && $pivot->pivot->unlocked) {
                continue;
            }

            $progress = $this->computeProgress($user, $achievement);

            $user->achievements()->syncWithoutDetaching([
                $achievement->id => ['progress' => $progress],
            ]);

            if ($progress >= $achievement->condition_value) {
                $user->achievements()->updateExistingPivot($achievement->id, [
                    'unlocked' => true,
                    'unlocked_at' => now(),
                    'progress' => $progress,
                ]);

                $this->awardXp($user, $achievement->xp_reward);

                $unlocked[] = $achievement;
            } else {
                $user->achievements()->updateExistingPivot($achievement->id, [
                    'progress' => $progress,
                ]);
            }
        }

        return $unlocked;
    }

    private function computeProgress(User $user, Achievement $achievement): int
    {
        return match ($achievement->condition_type) {
            'transaction_count' => $user->transactions()
                ->where('type', $achievement->slug === 'first_expense' ? 'expense' : (
                    $achievement->slug === 'first_income' ? 'income' : (
                        $achievement->slug === 'foodie' ? 'expense' : (
                            $achievement->slug === 'shopping_star' ? 'expense' : null
                        )
                    )
                ))
                ->when($achievement->slug === 'foodie', fn($q) => $q->whereHas('category', fn($q) => $q->where('name', 'Food')))
                ->when($achievement->slug === 'shopping_star', fn($q) => $q->whereHas('category', fn($q) => $q->where('name', 'Shopping')))
                ->count(),

            'xp_total' => $user->stat->xp ?? 0,

            'streak' => $user->stat->streak ?? 0,

            'savings' => $user->transactions()
                ->selectRaw('SUM(CASE WHEN type = ? THEN amount ELSE 0 END) - SUM(CASE WHEN type = ? THEN amount ELSE 0 END) as balance', ['income', 'expense'])
                ->value('balance') ?? 0,

            'transactions_count' => $user->transactions()->count(),

            'income_count' => $user->transactions()->where('type', 'income')->count(),

            'expense_count' => $user->transactions()->where('type', 'expense')->count(),

            default => 0,
        };
    }

    public function getDashboardData(User $user): array
    {
        $stat = $this->getStats($user);
        $nextLevelXp = UserStat::xpForLevel($stat->level + 1);
        $currentLevelXp = UserStat::xpForLevel($stat->level);
        $progressInLevel = $nextLevelXp > $currentLevelXp
            ? (($stat->xp - $currentLevelXp) / ($nextLevelXp - $currentLevelXp)) * 100
            : 100;

        $recentAchievements = $user->achievements()
            ->wherePivot('unlocked', true)
            ->orderByPivot('unlocked_at', 'desc')
            ->take(3)
            ->get();

        $inProgress = $user->achievements()
            ->wherePivot('unlocked', false)
            ->wherePivot('progress', '>', 0)
            ->orderByPivot('progress', 'desc')
            ->take(3)
            ->get();

        return [
            'xp' => $stat->xp,
            'level' => $stat->level,
            'title' => UserStat::levelTitle($stat->level),
            'streak' => $stat->streak,
            'next_level_xp' => $nextLevelXp,
            'current_level_xp' => $currentLevelXp,
            'progress_in_level' => round($progressInLevel, 1),
            'recent_achievements' => $recentAchievements,
            'in_progress_achievements' => $inProgress,
        ];
    }
}
