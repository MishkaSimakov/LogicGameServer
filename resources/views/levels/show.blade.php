@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $level->title }}

                        <a
                            href="{{ route('level.edit', compact('level')) }}"
                            class="ms-3"
                            title="Редактировать"
                        >
                            <span class="fas fa-pen"></span>
                        </a>
                    </div>

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

                        <div class="mt-3">
                            <p><b>Тесты</b></p>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        @foreach($level->inputs as $input)
                                            <th class="col">{{ $input->name }}</th>
                                        @endforeach
                                        @foreach($level->outputs as $output)
                                            <th class="col">{{ $output->name }}</th>
                                        @endforeach
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($level->tests as $test)
                                        <tr>
                                            @foreach($test->values as $value)
                                                <td>
                                                    <input
                                                        type="checkbox"
                                                        @if ($value->value) checked @endif
                                                        style="pointer-events: none;"
                                                        onclick="return false;"
                                                    />
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
