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
                <h2 class="fw-bold text-warning">Editar usuario</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('staff.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card p-5">
        <form action="{{ route('staff.update') }}" method="POST" class="form w-100" novalidate="novalidate"
            id="kt_sign_up_form" data-kt-redirect-url="{{ route('app.index') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            <div class="row mb-3">
                <div class="fv-row col-md-6">
                    <label for="name" class="form-label text-warning fs-5 required fw-bold">Nombre</label>
                    <input type="text" placeholder="Nombre" name="name" autocomplete="off" class="form-control" value="{{ $user->staff->name }}" />
                </div>

                <div class="fv-row col-md-6">
                    <label for="email" class="form-label text-warning fs-5 required fw-bold">Correo electrónico</label>
                    <input type="text" placeholder="Correo electrónico" name="email" autocomplete="off"
                        class="form-control" value="{{ $user->staff->email }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="fv-row col-md-6" data-kt-password-meter="true">
                    <div class="mb-1">
                        <label for="password" class="form-label text-warning fs-5 required fw-bold">Contraseña</label>
                        <div class="position-relative mb-3">
                            <input class="form-control" type="password" placeholder="Contraseña" name="password"
                                autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                            </span>
                        </div>

                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                            </div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                    </div>

                    <div class="text-warning">Use al menos 8 carácteres mezclados entre letras, números y simbolos.</div>
                </div>

                <div class="fv-row col-md-6">
                    <label for="confirm_password" class="form-label text-warning fs-5 required fw-bold">Repetir
                        Contraseña</label>
                    <input placeholder="Repetir contraseña" name="confirm_password" type="password" autocomplete="off"
                        class="form-control" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="fv-row col-md-6">
                    <label for="medical_center_id" class="form-label text-warning fs-5 required fw-bold">Centro
                        médico</label>
                    <select name="medical_center_id" class="form-select form-select-solid">
                        <option value="">Seleccionar</option>
                        @if (isset($centers) && $centers->count() > 0)
                            @foreach ($centers as $row)
                                <option {{ $user->medical_center_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->short_name) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="fv-row col-md-6">
                    <label for="role_id" class="form-label text-warning fs-5 required fw-bold">Rol</label>
                    <select name="role_id" class="form-select form-select-solid">
                        <option value="">Seleccionar</option>
                        @if (isset($roles) && $roles->count() > 0)
                            @foreach ($roles as $row)
                                <option {{ $user->staff->role_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->display_name) }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row mb-5 mt-5">
                <div class="text-center">
                    <button type="submit" class="btn btn-md btn-warning btn-active-light-warning text-white fw-bold">
                        Guardar
                    </button>
                </div>
            </div>



        </form>
    </div>
@endsection


@section('scripts')
@endsection
