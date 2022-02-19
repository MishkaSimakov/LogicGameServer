@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $level->title }}</div>

                    <div class="card-body">
                        {{ $level->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
