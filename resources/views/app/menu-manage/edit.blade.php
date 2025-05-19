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
                <h2 class="fw-bold text-warning">Editar menú</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('menu.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('menu.update') }}" class="form mb-15" method="post" id="kt_careers_form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $menu->id }}">
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre"
                                name="name" value="{{ $menu->name }}" />
                        </div>

                        <div class="col-md-3 fv-row">
                            <label for="icon" class="form-label text-warning required fs-5 fw-semibold mb-2">Icono</label>
                            <input type="text" class="form-control form-control-solid" placeholder="ki-duotone ki-..."
                                name="icon" value="{{ $menu->icon }}" />
                        </div>

                        <div class="col-md-3 fv-row">
                            <label for="icon_items" class="form-label text-warning required fs-5 fw-semibold mb-2">Items</label>
                            <select name="icon_items" class="form-select form-select-solid">
                                @for ($i =1; $i <= 10; $i++)
                                    <option {{ $menu->icon_items == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
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
