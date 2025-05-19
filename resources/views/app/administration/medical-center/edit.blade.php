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
                <h2 class="fw-bold text-warning">Editar centro médico</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('medical.center.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('medical.center.update') }}" class="form mb-15" method="post" id="kt_careers_form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $center->id }}">

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre"
                                name="name" value="{{ $center->name }}" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="short_name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre corto</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre corto"
                                name="short_name" value="{{ $center->short_name }}" />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="document" class="form-label text-warning required fs-5 fw-semibold mb-2">Rif</label>
                            <input type="text" class="form-control form-control-solid" placeholder="J1234567890"
                                name="document" value="{{ $center->document }}" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="state_id" class="form-label text-warning required fs-5 fw-semibold mb-2">Estado</label>
                            <select name="state_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($states) && $states->count() > 0)
                                    @foreach ($states as $row)
                                        <option {{ $center->state_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->name)}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="municipality_id" class="form-label text-warning required fs-5 fw-semibold mb-2">Municipio</label>
                            <select name="municipality_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($municipalities) && $municipalities->count() > 0)
                                    @foreach ($municipalities as $row)
                                        <option {{ $center->municipality_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->name)}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="parish_id" class="form-label text-warning required fs-5 fw-semibold mb-2">Parroquia</label>
                            <select name="parish_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($parishes) && $parishes->count() > 0)
                                    @foreach ($parishes as $row)
                                        <option {{ $center->parish_id == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ ucwords($row->name)}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-5 p-5">
                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                            <input class="form-check-input w-45px h-30px" type="checkbox" name="active" value="1"
                            {{ $center->active ? 'checked' : '' }}>
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
