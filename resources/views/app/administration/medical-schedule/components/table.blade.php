<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th>ID</th>
                <th>Centro médico</th>
                <th>Área</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Cupos</th>
                <th>Activo</th>
                <th>Fecha</th>
                <th class="text-end">Acciones</th>
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
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->medicalCenter->short_name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->medicalArea->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->day }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->hour }} </span>
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
                            <span class="text-gray-900 fw-bold">{{ $row->created_at->format('d/m/y') }} </span>
                            <br>
                            <span class="text-muted">{{ $row->created_at->format('H:i:s') }} </span>
                        </td>
                        <td class="text-end">
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
