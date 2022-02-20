<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
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
        $level = Level::create($request->only(['title', 'description']));

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

        return redirect($level->url);
    }
}
