<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelTest extends Model
{
    use HasFactory;

    protected $fillable = ['order'];

    public function values(): HasMany
    {
        return $this->hasMany(LevelTestValue::class);
    }

    public function getAsBooleanArrayAttribute()
    {
        return $this->values->map->value;
    }
}
