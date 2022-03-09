<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Level extends Model
{
    use HasFactory;

    const INPUT = 'input';
    const OUTPUT = 'output';

    protected $fillable = ['title', 'description', 'visible_tests_count', 'order'];

    protected static function booted()
    {
        static::addGlobalScope('ordered', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    public function getUrlAttribute(): string
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

    public function tests(): HasMany
    {
        return $this->hasMany(LevelTest::class);
    }


    public function createAllowedComponentsFromRequest(Request $data): Level
    {
        foreach ($data->get('allowed_components') as $allowed_component) {
            $this->allowedComponents()->attach(json_decode($allowed_component)->key);
        }

        return $this;
    }

    public function createTransputsFromRequest(Request $request): Level
    {
        foreach ($request->get('inputs') as $input) {
            $this->transputs()->create([
                'name' => json_decode($input)->value,
                'type' => Level::INPUT
            ]);
        }
        foreach ($request->get('outputs') as $output) {
            $this->transputs()->create([
                'name' => json_decode($output)->value,
                'type' => Level::OUTPUT
            ]);
        }

        return $this;
    }

    public function createTestsFromRequest(Request $request): Level
    {
        if ($request->exists('test_inputs')) {
            for ($i = 0; $i < count($request->get('test_inputs')); $i++) {
                $test = $this->tests()->create([
                    'order' => $i
                ]);

                foreach ($request->get('test_inputs')[$i] as $transput => $value) {
                    $test_value = $test->values()->make([
                        'value' => $value == "on"
                    ]);

                    $test_value->transput()->associate(
                        LevelTransput::where('level_id', $this->id)
                            ->where('type', Level::INPUT)
                            ->where('name', $transput)->first()
                    );

                    $test_value->save();
                }
                foreach ($request->get('test_outputs')[$i] as $transput => $value) {
                    $test_value = $test->values()->make([
                        'value' => $value == "on"
                    ]);

                    $test_value->transput()->associate(
                        LevelTransput::where('level_id', $this->id)
                            ->where('type', Level::OUTPUT)
                            ->where('name', $transput)->first()
                    );

                    $test_value->save();
                }
            }
        }

        return $this;
    }
}
