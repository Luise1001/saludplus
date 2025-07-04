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
                <h2 class="fw-bold text-warning">Editar especialista</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('doctor.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('doctor.update') }}" class="form mb-15" method="post" id="kt_careers_form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombres</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre"
                                name="name" value="{{ $doctor->name }}" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="last_name" class="form-label text-warning required fs-5 fw-semibold mb-2">Apellidos</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre corto"
                                name="last_name" value="{{ $doctor->last_name }}"  />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="document" class="form-label text-warning required fs-5 fw-semibold mb-2">Cédula</label>
                            <input type="text" class="form-control form-control-solid" placeholder="123456789"
                                name="document" value="{{ $doctor->document }}"  />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="phone" class="form-label text-warning required fs-5 fw-semibold mb-2">Teléfono</label>
                            <input type="text" class="form-control form-control-solid" placeholder="04123456789"
                                name="phone" value="{{ $doctor->phone }}"  />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="address" class="form-label text-warning required fs-5 fw-semibold mb-2">Dirección</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Dirección"
                                name="address" value="{{ $doctor->address }}"  />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="medical_area_id" class="form-label text-warning required fs-5 fw-semibold mb-2">Área de atención</label>
                            <select name="medical_area_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($areas) && $areas->count() > 0)
                                    @foreach ($areas as $row)
                                        <option {{ $doctor->medical_area_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->name)}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5 p-5">
                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                            <input class="form-check-input w-45px h-30px" type="checkbox" name="active" value="1" {{ $doctor->active ? 'checked' : '' }} id="active">
                            <label class="form-check-label" for="active">Activo</label>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-warning btn-active-light-warning" id="kt_careers_submit_button">
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
