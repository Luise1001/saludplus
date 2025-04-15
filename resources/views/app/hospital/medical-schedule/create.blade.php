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
                <h2 class="fw-bold text-warning">Crear horario</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('hospital.schedule.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('hospital.schedule.create') }}" class="form mb-15" method="post"
                    id="kt_careers_form">
                    @csrf
                    <div class="row mb-5">
                        <div class="fv-row col-md-6">
                            <label for="medical_area_id" class="form-label text-warning required fs-5 fw-semibold mb-2">Área
                                de atención</label>
                            <select name="medical_area_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($areas) && count($areas) > 0)
                                    @foreach ($areas as $row)
                                        <option value="{{ $row->id }}">{{ ucwords($row->name) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="fv-row col-md-6">
                            <label for="days"
                                class="form-label text-warning required fs-5 fw-semibold mb-2">Días</label>
                            <select multiple data-control="select2" name="days[]" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($days) && count($days) > 0)
                                    @foreach ($days as $key => $row)
                                        <option value="{{ $key }}">{{ ucwords($row) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="fv-row col-md-6">
                            <label for="hour"
                                class="form-label text-warning required fs-5 fw-semibold mb-2">Hora</label>
                            <select name="hour" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($hours) && count($hours) > 0)
                                    @foreach ($hours as $row)
                                        <option value="{{ $row }}">{{ ucwords($row) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="fv-row col-md-6">
                            <label for="slots"
                                class="form-label text-warning required fs-5 fw-semibold mb-2">Cupos</label>
                            <input type="number" min="1" max="100" class="form-control form-control-solid"
                                placeholder="Cupos" name="slots" />
                        </div>
                    </div>

                    <div class="row mb-5 p-5">
                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                            <input class="form-check-input w-45px h-30px" type="checkbox" name="active" value="1">
                            <label class="form-check-label" for="active">Activo</label>
                        </div>
                    </div>


                    <div class="separator mb-5"></div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning btn-active-light-warning"
                            id="kt_careers_submit_button">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
