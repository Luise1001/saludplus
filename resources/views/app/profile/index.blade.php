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

    <div id="kt_app_content" class="app-content flex-column-fluid mt-5">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="card mb-5">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold text-warning m-0">Usuario</h3>
                    </div>
                </div>

                <div class="card-body p-9">
                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-warning">Nombres</label>

                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ ucwords($user->name) }} </span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-warning">Correo electrónico</label>
                        <div class="col-lg-8 fv-row">
                            <span class="fw-semibold text-gray-800 fs-6">{{ $user->email }} </span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <label class="col-lg-4 fw-semibold text-warning">Rol</label>
                        <div class="col-lg-8 d-flex align-items-center">
                            <span class="fw-bold fs-6 text-gray-800 me-2">{{ $user->role->display_name }} </span>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($patient) && $patient)
                <div class="card mb-5">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold text-warning m-0">Paciente</h3>
                        </div>
                    </div>

                    <div class="card-body p-9">
                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Nombres</label>

                            <div class="col-lg-8">
                                <span class="text-gray-900">{{ ucwords($patient->name . ' ' . $patient->last_name) }} </span>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Cédula</label>
                            <div class="col-lg-8 fv-row">
                                <span class="text-gray-900">{{ $patient->document }} </span>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Edad</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="text-gray-900">{{ $patient->age }} </span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Fecha de Nacimiento</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="text-gray-900">{{ date('d-m-Y', strtotime($patient->birthday)) }} </span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Teléfono</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="text-gray-900">{{ $patient->phone }} </span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Dirección</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span
                                    class="text-gray-900">{{ $patient->state->name . ', ' . $patient->municipality->name . ', ' . $patient->parish->name }}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-lg-4 fw-semibold text-warning">Sector</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="text-gray-900">{{ ucwords($patient->sector) }} </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($user->role->level < 3 || $user->role->level == 10)
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold text-warning m-0">Cambiar Contraseña</h3>
                        </div>
                    </div>

                    <div class="card-body p-9">
                        <form action="{{ route('profile.password.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="row mb-3">
                                <div class="fv-row">
                                    <label for="current_password"
                                        class="form-label fw-bold text-warning required">Contraseña
                                        actual</label>
                                    <input name="current_password" type="password" class="form-control form-control-solid"
                                        placeholder="Contraseña actual" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="fv-row">
                                    <label for="new_password" class="form-label fw-bold text-warning required">Nueva
                                        Contraseña</label>
                                    <input name="new_password" type="password" class="form-control form-control-solid"
                                        placeholder="Nueva Contraseña" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="fv-row">
                                    <label for="confirm_password" class="form-label fw-bold text-warning required">Confirmar
                                        Contraseña</label>
                                    <input name="confirm_password" type="password" class="form-control form-control-solid"
                                        placeholder="Confirmar Contraseña" />
                                </div>
                            </div>

                            <div class="row mb-3 text-center mt-5">
                                <div class="fv-row">
                                    <button type="submit"
                                        class="btn btn-warning btn-active-light-warning fw-bold">Actualizar</button>
                                </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
@endsection
