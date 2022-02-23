<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Models\Level;
use App\Models\LevelTransput;
use App\Models\LogicalComponent;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::all();

        return view('levels.index', compact('levels'));
    }

    public function show(Level $level)
    {
        return view('levels.show', compact('level'));
    }

    public function create()
    {
        $logical_components = LogicalComponent::all();

        return view('levels.create', compact('logical_components'));
    }

    public function store(StoreLevelRequest $request)
    {
        $level = Level::create(array_merge(
            $request->only(['title', 'description', 'visible_tests_count']),
            [
                'order' => Level::count()
            ]
        ));

        foreach ($request->get('allowed_components') as $allowed_component) {
            $level->allowedComponents()->attach(json_decode($allowed_component)->key);
        }

        foreach ($request->get('inputs') as $input) {
            $level->transputs()->create([
                'name' => json_decode($input)->value,
                'type' => Level::INPUT
            ]);
        }
        foreach ($request->get('outputs') as $output) {
            $level->transputs()->create([
                'name' => json_decode($output)->value,
                'type' => Level::OUTPUT
            ]);
        }

        if ($request->exists('test_inputs')) {
            for ($i = 0; $i < count($request->get('test_inputs')); $i++) {
                $test = $level->tests()->create([
                    'order' => $i
                ]);

                foreach ($request->get('test_inputs')[$i] as $transput => $value) {
                    $test_value = $test->values()->make([
                        'value' => $value == "on"
                    ]);

                    $test_value->transput()->associate(
                        LevelTransput::where('level_id', $level->id)
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
                        LevelTransput::where('level_id', $level->id)
                            ->where('type', Level::OUTPUT)
                            ->where('name', $transput)->first()
                    );

                    $test_value->save();
                }
            }
        }

        return redirect($level->url);
    }

    public function destroy(Level $level)
    {
        Level::where('order', '>', $level->order)->get()->each->decrement('order');

        $level->delete();

        return redirect()->route('level.index');
    }

    public function moveUp(Level $level)
    {
        if (($levels = Level::where('order', '=', $level->order - 1))->count() > 0) {
            $levels->latest('order')->first()->increment('order');
            $level->decrement('order');
        }

        return redirect()->route('level.index');
    }

    public function moveDown(Level $level)
    {
        if (($levels = Level::where('order', '=', $level->order + 1))->count() > 0) {
            $levels->first()->decrement('order');
            $level->increment('order');
        }

        return redirect()->route('level.index');
    }
}
