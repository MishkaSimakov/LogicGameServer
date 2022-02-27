<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogicalComponent extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    public function getAsTagsAttribute()
    {
        return [
            'key' => $this->id,
            'value' => $this->name
        ];
    }
}
