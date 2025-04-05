@extends('app.layouts.index')

@section('styles')
<style>
    body {
        background-image: url({{ asset('assets/media/auth/bg10.jpeg') }});
    }

    [data-bs-theme="dark"] body {
        background-image: url({{ asset('assets/media/auth/bg10-dark.jpeg') }});
    }
</style>
@endsection

@section('content')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/agency.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('assets/media/auth/agency-dark.png') }}" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>

                    <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post,
                        <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person
                        they’ve interviewed
                        <br />and provides some background information about
                        <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
                        <br />work following this is a transcript of the interview.
                    </div>
                </div>
            </div>

            <div
                class="shadow-md d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">

                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            @include('app.layouts.components.alerts')
                            
                            <form action="{{ route('auth.login') }}" method="POST" class="form w-100" novalidate="novalidate"
                                id="kt_sign_in_form" data-kt-redirect-url="{{ route('app.index') }}">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Salud Plus</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Iniciar Sesión</div>
                                </div>

                                {{-- <div class="row g-3 mb-9">
                                    <div class="">
                                        <a href="#"
                                            class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg"
                                                class="h-15px me-3" />Continuar con google</a>
                                    </div>

                                </div>

                                <div class="separator separator-content my-14">
                                    <span class="w-125px text-gray-500 fw-semibold fs-7">correo eléctronico</span>
                                </div> --}}

                                <div class="fv-row mb-8">
                                    <label for="email" class="required form-label fs-5 fw-bold">Correo eléctronico
                                    </label>
                                    <input type="text" placeholder="Correo eléctronico" name="email" autocomplete="off"
                                        class="form-control bg-transparent" />
                                </div>

                                <div class="fv-row mb-3">
                                    <label for="password" class="form-label required fs-5 fw-bold">Contraseña</label>
                                    <input type="password" placeholder="Contraseña" name="password" autocomplete="off"
                                        class="form-control bg-transparent" />
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="{{ route('password.email') }}" class="link-primary">Olvidó
                                        su contraseña?</a>
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Acceder</span>
                                        <span class="indicator-progress">Por favor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>

                                <div class="text-gray-500 text-center fw-semibold fs-6">Aún no tienes cuenta?
                                    <a href="{{ route('register') }}" class="link-primary">Registrar</a>
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