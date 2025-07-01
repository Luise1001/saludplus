@extends('app.layouts.index')

@section('styles')
    @livewireStyles()
@endsection

@section('sidebar')
    @include('app.layouts.components.sidebar')
@endsection

@section('header')
    @include('app.layouts.components.navbar')
@endsection


@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid mt-5">
        @include('app.layouts.components.alerts')
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-5">

                    <div class="position-relative mb-5 mt-5">
                        <div class="overlay overlay-show">
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                                style="background-image:url('{{ asset('assets/media/auth/register.png') }}')"></div>
                            <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                        </div>

                        <div class="position-absolute text-warning mb-8 ms-10 bottom-0">
                            <h3 class="text-warning fs-2qx fw-bold mb-3 m">Registro de pacientes</h3>
                            <div class="fs-5 fw-semibold">Este formulario solo se solicitará solo una vez para obtener los
                                datos
                                necesarios del solicitante.</div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            @livewire('app.patients.patient-location-selector', ['document' => $document])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @livewireScripts()
    <script>
        $("#birthday").flatpickr({
            dateFormat: "d-m-Y",
            mode: "single"
        });
    </script>
@endsection
