@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $level->title }}</div>

                    <div class="card-body">
                        <p>
                            <b>Описание:</b> {{ $level->description }}
                        </p>
                        <p>
                            <b>Разрешённые логические
                                компоненты:</b> {{ $level->allowedComponents()->pluck('name')->implode(', ') }}
                        </p>
                        <p>
                            <b>Входы:</b> {{ $level->inputs()->pluck('name')->implode(', ') }}<br>
                            <b>Выходы:</b> {{ $level->outputs()->pluck('name')->implode(', ') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
