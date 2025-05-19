@extends('app.layouts.index-auth')

@section('styles')
@endsection

@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">


            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-200px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/doctors.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/doctors.png') }}" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Rápido, Eficiente y Productivo</h1>

                    <div class="text-gray-600 fs-base text-center fw-semibold">
                        <p class="mb-5">Salud Plus es un sistema de gestión de citas médicas que permite a los pacientes
                            agendar citas con médicos de manera rápida y eficiente.</p>
                        <p class="mb-5">Con una interfaz intuitiva y fácil de usar, los pacientes pueden buscar médicos
                            por especialidad, disponibilidad y ubicación.</p>
                    </div>
                </div>
            </div>

            <div
                class="shadow-md d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">

                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            @include('app.layouts.components.alerts')
                            
                            <form method="POST" action="{{ route('password.update') }}" class="form w-100"
                                novalidate="novalidate" id="kt_new_password_form"
                                data-kt-redirect-url="{{ route('app.index') }}">
                                @csrf
                                <div class="text-center mb-10">
                                    <img alt="Logo" src="{{ asset('assets/media/svg/saludplus/icon_text_orange.svg') }}" class="h-50px" />
                                    
                                    <h1 class="text-warning fw-bolder mb-3 mt-5">Establecer nueva contraseña</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Ya has recuperado tu contraseña ?
                                        <a href="{{ route('login') }}"
                                            class="link-warning fw-bold">Iniciar Sesión</a>
                                    </div>
                                </div>

                                <div class="fv-row mb-8">
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <input type="hidden" name="email" value="{{ $request->email }}">

                                    <label for="email" class="form-label text-warning required fs-5 fw-bold">Correo
                                        electrónico</label>
                                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                                        class="form-control" value="{{ $request->email }}" />
                                </div>

                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <div class="mb-1">
                                        <div class="position-relative mb-3">
                                            <label for="password"
                                                class="form-label text-warning required fs-5 fw-bold">Contraseña</label>
                                            <input class="form-control" type="password"
                                                placeholder="Contraseña" name="password" autocomplete="off" />
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                    </div>
                                    <div class="text-warning">Use al menos 8 carácteres mezclados entre letras, números y
                                        simbolos.</div>
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="password_confirmation" class="form-label text-warning required fs-5 fw-bold">Confirmar
                                        contraseña</label>
                                    <input type="password" placeholder="Confirmar contraseñá" name="password_confirmation"
                                        autocomplete="off" class="form-control" />
                                </div>

                                <div class="row mb-5">
                                    {{-- <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                        <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Acepto los
                                            <a href="#" class="ms-1 link-primary">Terminos y condiciones</a></span>
                                    </label> --}}
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_new_password_submit" class="btn btn-warning  btn-active-light-warningfw-bold text-white">
                                        <span class="indicator-label">Enviar</span>
                                        <span class="indicator-progress">Por favor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
