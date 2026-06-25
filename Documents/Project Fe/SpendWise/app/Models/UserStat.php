<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserStat extends Model
{
    protected $fillable = [
        'user_id', 'xp', 'level', 'streak',
        'last_active_date', 'daily_challenges', 'challenge_progress',
    ];

    protected function casts(): array
    {
        return [
            'daily_challenges' => 'array',
            'challenge_progress' => 'array',
            'last_active_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function levelForXp(int $xp): int
    {
        return min((int) floor(sqrt($xp / 100)) + 1, 50);
    }

    public static function xpForLevel(int $level): int
    {
        return ($level - 1) * ($level - 1) * 100;
    }

    public static function levelTitle(int $level): string
    {
        return match (true) {
            $level >= 10 => 'SpendWise Legend',
            $level >= 9 => 'Budget Champion',
            $level >= 8 => 'Financial Wizard',
            $level >= 7 => 'Money Master',
            $level >= 6 => 'Savings Expert',
            $level >= 5 => 'Finance Hero',
            $level >= 4 => 'Budget Explorer',
            $level >= 3 => 'Money Planner',
            $level >= 2 => 'Smart Saver',
            default => 'Budget Beginner',
        };
    }
}
