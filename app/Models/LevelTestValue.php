<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class LevelTestValue extends Model
{
    protected $fillable = ['value', 'level_transput_id'];
    public $timestamps = false;

    public function scopeInput(Builder $builder): Builder
    {
        return $builder->whereHas('transput', function (Builder $builder) {
            $builder->where('type', Level::INPUT);
        });
    }

    public function scopeOutput(Builder $builder): Builder
    {
        return $builder->whereHas('transput', function (Builder $builder) {
            $builder->where('type', Level::OUTPUT);
        });
    }

    public function transput(): BelongsTo
    {
        return $this->belongsTo(LevelTransput::class, 'level_transput_id', 'id');
    }
}
