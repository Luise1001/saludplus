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
                        @include('app.layouts.components.alerts')

                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form action="{{ route('patient.register') }}" method="GET" class="form w-100"
                                novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="index.html">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Salud Plus</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Acceder al sistema</div>
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="document" class="required fw-bold">Cédula</label>
                                    <input type="text" placeholder="123456789" name="document" autocomplete="off"
                                        class="form-control bg-transparent" />
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        Acceder
                                    </button>
                                </div>

                                <div class="text-gray-500 text-center fw-semibold fs-6">Ya tienes cuenta?
                                    <a href="{{ route('login') }}" class="link-primary">Iniciar
                                        sesión</a>
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
