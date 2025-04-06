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

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17">

                    <div class="position-relative mb-17">
                        <div class="overlay overlay-show">
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                                style="background-image:url('assets/media/stock/1600x800/img-1.jpg')"></div>
                            <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                        </div>

                        <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                            <h3 class="text-white fs-2qx fw-bold mb-3 m">Registro de pacientes</h3>
                            <div class="fs-5 fw-semibold">Este formulario solo se solicitará solo una vez para obtener los
                                datos
                                necesarios del solicitante.</div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <form action="{{ route('patient.register') }}" class="form mb-15" method="post"
                                id="kt_careers_form">
                                @csrf
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="document"
                                            class="form-label required fs-5 fw-semibold mb-2">Cédula</label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="123456789" name="document" value="{{ $document ?? '' }}" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="birth_date" class="form-label required fs-5 fw-semibold mb-2">Fecha de
                                            nacimiento</label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Fecha de nacimiento" id="birth_date" name="birth_date" />
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="name"
                                            class="form-label required fs-5 fw-semibold mb-2">Nombres</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Nombres"
                                            name="name" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="last_name"
                                            class="form-label required fs-5 fw-semibold mb-2">Apellidos</label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Apellidos" name="last_name" />
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="email" class="form-label required fs-5 fw-semibold mb-2">Correo
                                            eléctronico</label>
                                        <input class="form-control form-control-solid" placeholder="ejemplo@ejemplo.com"
                                            name="email" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="phone"
                                            class="form-label required fs-5 fw-semibold mb-2">Teléfono</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Teléfono"
                                            name="phone" />
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="age" class="form-label required fs-5 fw-semibold mb-2">Edad</label>
                                        <input type="text" class="form-control form-control-solid" placeholder="Edad"
                                            name="age" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="state_id"
                                            class="form-label required fs-5 fw-semibold mb-2">Estádo</label>
                                        <select name="state_id" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            @if (isset($states) && $states->count() > 0)
                                                @foreach ($states as $row)
                                                    <option value="{{ $row->id }}">{{ ucwords($row->name) }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="municipality_id"
                                            class="form-label required fs-5 fw-semibold mb-2">Municipio</label>
                                        <select name="municipality_id" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            @if (isset($municipalities) && $municipalities->count() > 0)
                                                @foreach ($municipalities as $row)
                                                    <option value="{{ $row->id }}">{{ ucwords($row->name) }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="parish_id"
                                            class="form-label required fs-5 fw-semibold mb-2">Parroquia</label>
                                        <select name="parish_id" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            @if (isset($parishes) && $parishes->count() > 0)
                                                @foreach ($parishes as $row)
                                                    <option value="{{ $row->id }}">{{ ucwords($row->name) }} </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="sector"
                                            class="form-label required fs-5 fw-semibold mb-2">Sector</label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Sector" name="sector" />
                                    </div>
                                </div>

                                <div class="separator mb-8"></div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
                                        Guardar
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
    <script>
        $("#birth_date").flatpickr({
            dateFormat: "d-m-Y",
            mode: "single"
        });
    </script>
@endsection
