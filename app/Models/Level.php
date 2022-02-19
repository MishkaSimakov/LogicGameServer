<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
