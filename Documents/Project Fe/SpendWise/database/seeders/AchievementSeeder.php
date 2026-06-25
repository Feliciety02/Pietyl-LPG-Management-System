<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = [
            ['name' => 'First Expense', 'slug' => 'first_expense', 'description' => 'Record your very first expense!', 'emoji' => '🐣', 'category' => 'transactions', 'xp_reward' => 50, 'condition_type' => 'transaction_count', 'condition_value' => 1],
            ['name' => 'First Income', 'slug' => 'first_income', 'description' => 'Record your first income!', 'emoji' => '💸', 'category' => 'transactions', 'xp_reward' => 50, 'condition_type' => 'income_count', 'condition_value' => 1],
            ['name' => 'Foodie', 'slug' => 'foodie', 'description' => 'Track 50 food expenses.', 'emoji' => '🍔', 'category' => 'transactions', 'xp_reward' => 150, 'condition_type' => 'foodie', 'condition_value' => 50],
            ['name' => 'Shopping Star', 'slug' => 'shopping_star', 'description' => 'Track 100 shopping transactions.', 'emoji' => '🛍️', 'category' => 'transactions', 'xp_reward' => 200, 'condition_type' => 'shopping_star', 'condition_value' => 100],
            ['name' => 'Consistent Saver', 'slug' => 'consistent_saver', 'description' => 'Save money for 7 days straight!', 'emoji' => '🌸', 'category' => 'streak', 'xp_reward' => 100, 'condition_type' => 'streak', 'condition_value' => 7],
            ['name' => '30-Day Streak', 'slug' => 'thirty_day_streak', 'description' => 'Maintain a 30-day tracking streak!', 'emoji' => '🔥', 'category' => 'streak', 'xp_reward' => 300, 'condition_type' => 'streak', 'condition_value' => 30],
            ['name' => 'Budget Boss', 'slug' => 'budget_boss', 'description' => 'Stay under budget for an entire month.', 'emoji' => '🏆', 'category' => 'savings', 'xp_reward' => 250, 'condition_type' => 'savings', 'condition_value' => 1],
            ['name' => 'Wealth Builder', 'slug' => 'wealth_builder', 'description' => 'Reach your first $10,000 in savings!', 'emoji' => '💎', 'category' => 'savings', 'xp_reward' => 500, 'condition_type' => 'savings', 'condition_value' => 10000],
            ['name' => 'Financial Rocket', 'slug' => 'financial_rocket', 'description' => 'Earn 10,000 XP!', 'emoji' => '🚀', 'category' => 'xp', 'xp_reward' => 1000, 'condition_type' => 'xp_total', 'condition_value' => 10000],
            ['name' => 'Transaction Master', 'slug' => 'transaction_master', 'description' => 'Record 500 transactions total!', 'emoji' => '📊', 'category' => 'transactions', 'xp_reward' => 400, 'condition_type' => 'transactions_count', 'condition_value' => 500],
            ['name' => 'Week Warrior', 'slug' => 'week_warrior', 'description' => 'Track expenses every day for a week.', 'emoji' => '🔥', 'category' => 'streak', 'xp_reward' => 100, 'condition_type' => 'streak', 'condition_value' => 7],
            ['name' => 'Century Streak', 'slug' => 'century_streak', 'description' => 'Achieve a 100-day tracking streak!', 'emoji' => '🌈', 'category' => 'streak', 'xp_reward' => 1000, 'condition_type' => 'streak', 'condition_value' => 100],
            ['name' => 'First Week Tracking', 'slug' => 'first_week', 'description' => 'Track your finances for a full week.', 'emoji' => '🗓️', 'category' => 'milestone', 'xp_reward' => 75, 'condition_type' => 'transactions_count', 'condition_value' => 7],
            ['name' => 'Budget Master', 'slug' => 'budget_master', 'description' => 'Complete all budget goals for a month.', 'emoji' => '🧁', 'category' => 'goals', 'xp_reward' => 350, 'condition_type' => 'savings', 'condition_value' => 5000],
        ];

        foreach ($achievements as $data) {
            Achievement::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
