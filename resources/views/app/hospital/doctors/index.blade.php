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
                <h2 class="fw-bold text-warning">Especialistas</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('hospital.doctor.create') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    <i class="ki-duotone ki-plus-square fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>Nuevo
                </a>
            </div>
        </div>
    </div>

    <div class="card p-5">
        @include('app.hospital.doctors.components.table')
    </div>
@endsection


@section('scripts')
@endsection
