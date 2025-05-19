<div class="table-responsive">
    <div class="d-flex justify-content-end p-5">
        <a class="btn btn-sm btn-warning btn-active-light-warning" href="{{ route('hospital.schedule.create') }}">
            Nuevo
        </a>
    </div>

    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Área</th>
                <th class="text-warning">Día</th>
                <th class="text-warning">Hora</th>
                <th class="text-warning">Cupos</th>
                <th class="text-warning">Activo</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($schedules) && $schedules->count() > 0)
                @foreach ($schedules as $row)
                    <tr>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->medicalArea->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->day }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ date('h:i A', strtotime($row->hour)) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->slots }} </span>
                        </td>
                        <td>
                            @if ($row->active)
                                <span class="badge badge-light-success">SI</span>
                            @else
                                <span class="badge badge-light-danger">NO</span>
                            @endif
                        </td>
                        <td>
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                <a href="{{ route('medical.schedule.edit', ['id' => $row->id]) }}" class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button">
                                    <i class="ki-duotone ki-pencil fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
