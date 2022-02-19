<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelRequest;
use App\Models\Level;
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
        return view('levels.create');
    }

    public function store(StoreLevelRequest $request)
    {
        $level = Level::create($request->validated());

        return redirect($level->url);
    }
}
