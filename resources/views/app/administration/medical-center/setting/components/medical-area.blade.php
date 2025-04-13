<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="text-warning">ID</th>
                <th class="text-warning">Nombre</th>
                <th class="text-warning">Descripción</th>
                <th class="text-warning">Acciones</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($areas) && $areas->count() > 0)
                <form id="form_area" action="{{ route('medical.center.setting.areas') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="medical_center_id" value="{{ $center->id }}">
                    @foreach ($areas as $row)
                        <tr>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ ucwords($row->name) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->description }} </span>
                            </td>
                            <td>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="areas[]"
                                        value="{{ $row->id }}" @if ($center->medicalAreas->contains($row->id)) checked @endif>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </form>
            @endif
        </tbody>
    </table>

    <div class="card-body text-center">
        @if (isset($areas) && $areas->count() > 0)
            <button type="submit" form="form_area"
                class="btn btn-md btn-warning btn-active-light-warning">Guardar</button>
        @endif
    </div>
</div>
