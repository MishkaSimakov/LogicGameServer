<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelTransput extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function getAsTagsAttribute()
    {
        return [
            'key' => '',
            'value' => $this->name
        ];
    }
}
