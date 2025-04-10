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
                <h2 class="fw-bold text-warning">Crear permiso</h2>
            </div>

            <div class="card-toolbar">
                <a href="{{ route('permission.index') }}"class="btn btn-sm btn-warning btn-active-light-warning">
                    Listado
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-5 p-5">
        <div class="d-flex flex-column flex-lg-row mb-5">
            <div class="flex-lg-row-fluid me-0 me-lg-20">
                <form action="{{ route('permission.create') }}" class="form mb-15" method="post" id="kt_careers_form">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-md-6 fv-row">
                            <label for="name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre"
                                name="name" />
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="display_name" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre para
                                mostrar</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre para mostrar"
                                name="display_name" />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-3 fv-row">
                            <label for="menu" class="form-label text-warning required fs-5 fw-semibold mb-2">Menú</label>
                            <select name="menu_id" class="form-select form-select-solid">
                                <option value="">Seleccionar</option>
                                @if (isset($menus) && $menus->count() > 0)
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ ucwords($menu->name)}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 fv-row">
                            <label for="level" class="form-label text-warning required fs-5 fw-semibold mb-2">Nivel</label>
                            <select name="level" class="form-select form-select-solid">
                                @for ($i = auth()->user()->role->level; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6 fv-row">
                            <label for="route" class="form-label text-warning required fs-5 fw-semibold mb-2">Nombre de ruta</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre de ruta"
                                name="route" />
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="fv-row">
                            <label for="description" class="form-label text-warning fs-5 fw-semibold mb-2">Descripción</label>
                            <input class="form-control form-control-solid" placeholder="Descripción" name="description" />
                        </div>
                    </div>

                    <div class="row mb-5 p-5">
                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                            <input class="form-check-input w-45px h-30px" type="checkbox" name="active" value="1"
                                checked>
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
