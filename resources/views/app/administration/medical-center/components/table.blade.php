<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Nombre</th>
                <th class="text-warning">Rif</th>
                <th class="text-warning">Activo</th>
                <th class="text-warning">Estado</th>
                <th class="text-warning">Municipio</th>
                <th class="text-warning">Parroquia</th>
                <th class="text-warning">Fecha</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($centers) && $centers->count() > 0)
                @foreach ($centers as $row)
                    <tr>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->name) }} </span> <br>
                            <span class="text-muted">{{ ucwords($row->short_name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucfirst($row->document) }} </span>
                        </td>
                        <td>
                            @if ($row->active)
                                <span class="badge badge-light-success">SI</span>
                            @else
                                <span class="badge badge-light-danger">NO</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-gray-900">{{ ucwords($row->state->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900">{{ ucwords($row->municipality->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900">{{ ucwords($row->parish->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->created_at->format('d/m/y') }} </span>
                            <br>
                            <span class="text-muted">{{ $row->created_at->format('H:i:s') }} </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                <div data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                    <a href="{{ route('medical.center.edit', ['id' => $row->id]) }}"
                                        class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </div>

                                <div data-bs-toggle="tooltip" data-bs-placement="top" title="Configuración">
                                    <form action="{{ route('medical.center.setting.index') }}" method="get">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $row->id }}">
                                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="submit">
                                            <i class="ki-duotone ki-setting-2 fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
