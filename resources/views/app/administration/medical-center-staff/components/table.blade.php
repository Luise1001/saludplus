<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Centro médico</th>
                <th class="text-warning">Nombre</th>
                <th class="text-warning">Correo <br> electrónico</th>
                <th class="text-warning">Rol</th>
                <th class="text-warning">Fecha</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($users) && $users->count() > 0)
                @foreach ($users as $row)
                    <tr>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->medicalCenter->short_name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ ucwords($row->staff->name) }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->staff->email }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->staff->role->display_name }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->created_at->format('d/m/y') }} </span>
                            <br>
                            <span class="text-muted">{{ $row->created_at->format('H:i:s') }} </span>
                        </td>
                        <td>
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                <a href="{{ route('staff.edit', ['id' => $row->user_id]) }}"
                                    class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button">
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
