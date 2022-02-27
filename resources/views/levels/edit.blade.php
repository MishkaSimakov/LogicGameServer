@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $level->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('level.update', compact('level')) }}">
                            @csrf
                            @method('PUT')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" value="{{ old('title') ?? $level->title }}"
                                       id="title" name="title" required autofocus>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Описание</label>
                                <textarea
                                    class="form-control" id="description"
                                    name="description"
                                >{{ old('description') ?? $level->description }}</textarea>
                            </div>

                            <level-allowed-components-input
                                :existing-tags='@json($logical_components->map->asTags)'
                                :allowed-components-value='@json($level->allowedComponents->map->asTags)'
                            ></level-allowed-components-input>

                            <level-tests-input
                                :inputs-value='@json($level->inputs->map->asTags)'
                                :outputs-value='@json($level->outputs->map->asTags)'
                                value='@json($level->tests->map->asBooleanArray)'
                            ></level-tests-input>

                            <div class="form-group mt-3">
                                <label for="visible_tests_count">Количество видимых тестов</label>
                                <input type="number" class="form-control" id="visible_tests_count"
                                       name="visible_tests_count"
                                       min="0"
                                       value="{{ old('visible_tests_count') ?? $level->visible_tests_count }}" required>

                                <small class="small text-secondary">Игрокам будут видны первые тесты из тех, что вы
                                    ввели в таблицу</small>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
