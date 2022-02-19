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

                            <button type="submit" class="btn btn-primary mt-3">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
