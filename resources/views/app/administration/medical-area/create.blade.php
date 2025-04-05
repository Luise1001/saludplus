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
                <h2 class="fw-bold">Crear área de atención</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('medical.area.index') }}"class="btn btn-sm btn-primary btn-active-light-primary">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('medical.area.create') }}" class="form mb-15" method="post" id="kt_careers_form">
                    @csrf
                    <div class="row mb-5">
                        <div class="fv-row">
                            <label for="name" class="form-label required fs-5 fw-semibold mb-2">Nombre</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre"
                                name="name" />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="fv-row">
                            <label for="description" class="form-label required fs-5 fw-semibold mb-2">Descripción</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Descripción"
                                name="description" />
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
                        <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
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
