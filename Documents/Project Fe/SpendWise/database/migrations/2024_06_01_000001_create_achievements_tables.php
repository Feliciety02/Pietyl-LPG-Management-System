<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('emoji')->default('🏆');
            $table->string('category')->default('general');
            $table->integer('xp_reward')->default(0);
            $table->string('condition_type');
            $table->integer('condition_value')->default(1);
            $table->boolean('is_hidden')->default(false);
            $table->timestamps();
        });

        Schema::create('achievement_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('achievement_id')->constrained()->cascadeOnDelete();
            $table->integer('progress')->default(0);
            $table->boolean('unlocked')->default(false);
            $table->timestamp('unlocked_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'achievement_id']);
        });

        Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('xp')->default(0);
            $table->integer('level')->default(1);
            $table->integer('streak')->default(0);
            $table->date('last_active_date')->nullable();
            $table->json('daily_challenges')->nullable();
            $table->json('challenge_progress')->nullable();
            $table->timestamps();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_stats');
        Schema::dropIfExists('achievement_user');
        Schema::dropIfExists('achievements');
    }
};
