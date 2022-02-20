<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Models\Level;
use App\Models\LogicalComponent;

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
        dd($request->validated());

        $level = Level::create($request->validated());

        return redirect($level->url);
    }
}
