@extends('app.layouts.index')

@section('styles')
@endsection

@section('sidebar')
    @include('app.layouts.components.sidebar')
@endsection

@section('header')
    @include('app.layouts.components.navbar')
@endsection


@section('content')
    @include('app.layouts.components.alerts')

    <div class="card card-flush mb-3 mt-3">
        <div class="card-header">
            <div class="card-title">
                <h2 class="fw-bold text-warning">{{ $role->display_name }} </h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('role.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Lista de roles
                </a>
            </div>
        </div>
    </div>

    <div class="card p-5">
        @include('app.role.components.permissions')
    </div>
@endsection


@section('scripts')
@endsection
