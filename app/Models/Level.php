<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    const INPUT = 'input';
    const OUTPUT = 'output';

    protected $fillable = ['title', 'description'];

    public function getUrlAttribute()
    {
        return route('level.show', ['level' => $this]);
    }

    public function allowedComponents(): BelongsToMany
    {
        return $this->belongsToMany(LogicalComponent::class, 'level_allowed_components');
    }

    public function transputs(): HasMany
    {
        return $this->hasMany(LevelTransput::class);
    }

    public function inputs(): HasMany
    {
        return $this->transputs()->where('type', self::INPUT);
    }

    public function outputs(): HasMany
    {
        return $this->transputs()->where('type', self::OUTPUT);
    }
}
