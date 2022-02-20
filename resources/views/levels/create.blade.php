@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Новый уровень</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('level.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Название</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="description">Описание</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="outputs">Допустимые логические компоненты</label>
                                <tags-input wrapper-class="form-control" placeholder=""
                                            v-bind:existing-tags="[
                                                @foreach($logical_components as $logical_component)
                                                    {
                                                        key: {{ $logical_component->id }},
                                                        value: '{{ $logical_component->name }}'
                                                    }
                                                    @if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            ]"
                                            :typeahead="true"
                                            :typeahead-always-show="true"
                                            :only-existing-tags="true"
                                            :typeahead-hide-discard="true"
                                            element-id="allowed_components"></tags-input>
                            </div>

                            <div class="form-group mt-3">
                                <label for="inputs">Входы</label>
                                <tags-input wrapper-class="form-control" placeholder=""
                                            element-id="inputs"></tags-input>
                            </div>

                            <div class="form-group mt-3">
                                <label for="outputs">Выходы</label>
                                <tags-input wrapper-class="form-control" placeholder=""
                                            element-id="outputs"></tags-input>
                            </div>

                            <div class="form-group mt-3">
                                <label for="visible_count">Количество видимых тестов</label>
                                <input type="number" class="form-control" id="visible_count" name="visible_count"
                                       required>

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
