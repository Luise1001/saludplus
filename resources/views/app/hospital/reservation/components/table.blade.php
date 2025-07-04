<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Área</th>
                <th class="text-warning">Paciente</th>
                <th class="text-warning">Doctor</th>
                <th class="text-warning">Motivo</th>
                <th class="text-warning">Fecha</th>
                <th class="text-warning">Hora</th>
                <th class="text-warning">Observación</th>
                <th class="text-warning">Estatus</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($reservations) && $reservations->count() > 0)
                @foreach ($reservations as $row)
                    <tr>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->medicalArea->name }} </span>
                        </td>
                        <td>
                            <span
                                class="text-gray-900 fw-bold">{{ ucwords($row->patient->name . ' ' . $row->patient->last_name) }}
                            </span>
                        </td>
                        <td>
                            <span
                                class="text-gray-900 fw-bold">{{ ucwords($row->doctor->name . ' ' . $row->doctor->last_name) }}
                            </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->reason }} </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ date('d/m/y', strtotime($row->date)) }} </span>
                        </td>
                        <td>
                            <span
                                class="text-gray-900 fw-bold">{{ date('h:i A', strtotime($row->medicalSchedule->hour)) }}
                            </span>
                        </td>
                        <td>
                            <span class="text-gray-900 fw-bold">{{ $row->observation }} </span>
                        </td>
                        <td>
                            @if ($row->status == 'pendiente')
                                <span class="badge badge-warning fw-bold">{{ ucfirst($row->status) }} </span>
                            @elseif($row->status == 'procesado')
                                <span class="badge badge-success fw-bold">{{ ucfirst($row->status) }} </span>
                            @elseif($row->status == 'cancelado')
                                <span class="badge badge-danger fw-bold">{{ ucfirst($row->status) }} </span>
                            @else
                                <span class="badge badge-gray-900 fw-bold">{{ ucfirst($row->status) }} </span>
                            @endif
                        </td>
                        <td>
                            @if ($row->status == 'pendiente')
                                <div class="d-flex justify-content-end">
                                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Confirmar">
                                        <form action="{{ route('hospital.reservation.confirm') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button reservation="{{ $row }}"
                                                class="btn-confirm btn btn-sm btn-icon btn-active-light-primary me-1">
                                                <i class="ki-duotone ki-double-check fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </form>
                                    </div>

                                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Cancelar">
                                        <form action="{{ route('hospital.reservation.cancel') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <button reservation="{{ $row }}"
                                                class="btn-cancel btn btn-sm btn-icon btn-active-light-danger me-1">
                                                <i class="ki-duotone ki-cross-circle fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
