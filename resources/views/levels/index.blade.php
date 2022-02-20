@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список уровней</div>

                    <div class="card-body">
                        <a href="{{ route('level.create') }}">Создать уровень</a>

                        <div class="list-group mt-3">
                            @foreach($levels as $level)
                                <div class="list-group-item list-group-item-action">
                                    <div class="row gx-0">
                                        <a href="{{ $level->url }}" class="d-block col text-decoration-none">
                                            {{ $level->title }} ({{ $level->order }})
                                        </a>

                                        <div class="col-1 ms-auto text-center border-end">
                                            @if (!$loop->first)
                                                <a
                                                    href="{{ route('level.move-up', compact('level')) }}"
                                                    class="text-decoration-none text-secondary"
                                                    title="Переместить выше"
                                                >
                                                    ▲
                                                </a>
                                            @endif
                                            @if (!$loop->last)
                                                <a
                                                    href="{{ route('level.move-down', compact('level')) }}"
                                                    class="text-decoration-none ms-1 text-secondary"
                                                    title="Переместить ниже"
                                                >
                                                    ▼
                                                </a>
                                            @endif
                                        </div>

                                        <div class="col-1 text-center">
                                            <a
                                                href="#"
                                                class="text-decoration-none ms-1 text-danger fw-bolder"
                                                title="Удалить"
                                                onclick="document.getElementById('level-delete-from-{{ $level->id }}').submit()"
                                            >
                                                <span class="fas fa-xmark"></span>
                                            </a>

                                            <form id="level-delete-from-{{ $level->id }}" action="{{ route('level.destroy', compact('level')) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
