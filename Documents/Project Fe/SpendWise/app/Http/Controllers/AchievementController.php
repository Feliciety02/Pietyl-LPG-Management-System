<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Services\AchievementService;
use Inertia\Inertia;
use Inertia\Response;

class AchievementController extends Controller
{
    public function __construct(
        private readonly AchievementService $achievementService
    ) {}

    public function index(): Response
    {
        $user = auth()->user();
        $stats = $this->achievementService->getDashboardData($user);

        $allAchievements = Achievement::all()->map(function ($achievement) use ($user) {
            $pivot = $user->achievements()
                ->where('achievement_id', $achievement->id)
                ->first();

            return [
                'id' => $achievement->id,
                'name' => $achievement->name,
                'description' => $achievement->description,
                'emoji' => $achievement->emoji,
                'category' => $achievement->category,
                'xp_reward' => $achievement->xp_reward,
                'unlocked' => $pivot?->pivot->unlocked ?? false,
                'progress' => $pivot?->pivot->progress ?? 0,
                'condition_value' => $achievement->condition_value,
                'unlocked_at' => $pivot?->pivot->unlocked_at,
            ];
        });

        $unlocked = $allAchievements->where('unlocked', true);
        $locked = $allAchievements->where('unlocked', false);

        return Inertia::render('Achievements/Index', [
            'stats' => $stats,
            'unlocked_achievements' => $unlocked->values(),
            'locked_achievements' => $locked->values(),
            'total_achievements' => $allAchievements->count(),
            'unlocked_count' => $unlocked->count(),
        ]);
    }
}
