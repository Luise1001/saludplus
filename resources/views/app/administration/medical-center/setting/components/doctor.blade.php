<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Nombres</th>
                <th class="text-warning">Apellidos</th>
                <th class="text-warning">Cédula</th>
                <th class="text-warning">Teléfono</th>
                <th class="text-warning">Dirección</th>
                <th class="text-warning">Especialidad</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($doctors) && $doctors->count() > 0)
                <form id="form_doctor" action="{{ route('medical.center.setting.doctors') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="medical_center_id" value="{{ $center->id }}">
                    @foreach ($doctors as $row)
                        <tr>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ ucwords($row->name) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ ucwords($row->last_name) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ ucfirst($row->document) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->phone }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->address }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ ucwords($row->medicalArea->name) }} </span>
                            </td>
                            <td>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="doctors[]"
                                        value="{{ $row->id }}" @if ($center->doctors->contains($row->id)) checked @endif>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </form>
            @endif
        </tbody>
    </table>

    <div class="card-body text-center">
        <button type="submit" form="form_doctor"
            class="btn btn-md btn-warning btn-active-light-warning">Guardar</button>
    </div>
</div>
