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

    @if (!session('medical_center'))
        <div class="card card-flush mb-3 mt-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="fw-bold text-warning"> {{ ucwords($center->name) }} </h2>
                </div>
            </div>
        </div>
    @endif

    <div class="card p-5">
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-warning pb-4 active" data-bs-toggle="tab" href="#medical_area"
                    aria-selected="true" role="tab">Áreas de atención</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-warning pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#doctor"
                    data-kt-initialized="1" aria-selected="false" tabindex="-1" role="tab">Especialistas</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-warning pb-4" data-bs-toggle="tab" href="#schedule" aria-selected="false"
                    tabindex="-1" role="tab">Horarios </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link text-active-warning pb-4" data-bs-toggle="tab" href="#user" aria-selected="false"
                    tabindex="-1" role="tab">Usuarios </a>
            </li>
        </ul>

        <div class="tab-content" id="medical_center_settings">
            <div class="tab-pane fade show active" id="medical_area" role="tabpanel">
                @include('app.administration.medical-center.setting.components.medical-area', [
                    'areas' => $areas,
                ])
            </div>

            <div class="tab-pane fade text-gray-600" id="doctor" role="tabpanel">
                @include('app.administration.medical-center.setting.components.doctor', [
                    'doctors' => $doctors,
                ])
            </div>

            <div class="tab-pane fade text-gray-600" id="schedule" role="tabpanel">
                @include('app.administration.medical-center.setting.components.schedule', [
                    'schedules' => $schedules,
                ])
            </div>

            <div class="tab-pane fade text-gray-600" id="user" role="tabpanel">
                @include('app.administration.medical-center.setting.components.staff', [
                    'users' => $users,
                ])
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
