<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'emoji',
        'category', 'xp_reward', 'condition_type',
        'condition_value', 'is_hidden',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['progress', 'unlocked', 'unlocked_at'])
            ->withTimestamps();
    }
}
