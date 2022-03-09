<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\Level;
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

        $level->createAllowedComponentsFromRequest($request)
            ->createTransputsFromRequest($request)
            ->createTestsFromRequest($request);

        return redirect($level->url);
    }

    public function edit(Level $level)
    {
        $logical_components = LogicalComponent::all();

        return view('levels.edit', compact('level', 'logical_components'));
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->only(['title', 'description', 'visible_tests_count']));

        $level->allowedComponents()->sync([]);
        $level->transputs()->delete();
        $level->tests()->delete();

        $level->createAllowedComponentsFromRequest($request)
            ->createTransputsFromRequest($request)
            ->createTestsFromRequest($request);

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
