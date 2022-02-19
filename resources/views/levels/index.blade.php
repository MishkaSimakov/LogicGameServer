@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список уровней</div>

                    <div class="card-body">
                        <a href="{{ route('level.create') }}">Создать уровень</a>

                        <div class="list-group">
                            @foreach($levels as $level)
                                <a href="{{ $level->url }}" class="list-group-item list-group-item-action">{{ $level->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
