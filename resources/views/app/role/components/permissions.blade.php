<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th>ID</th>
                <th>Menú</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Asignado</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            @if (isset($permissions) && $permissions->count() > 0)
                <form action="{{ route('role.permission.async') }}", method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    @foreach ($permissions as $row)
                        <tr>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ $row->id }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ Str::upper($row->menu) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900 fw-bold">{{ Str::upper($row->display_name) }} </span>
                            </td>
                            <td>
                                <span class="text-gray-900">{{ $row->description }} </span>
                            </td>
                            <td>
                                <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input wire:model="role.permissions" class="form-check-input" type="checkbox"
                                        name="permissions[]" 
                                        value="{{ $row->id }}" @if ($role->permissions->contains($row->id)) checked @endif>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-end">
                            <button type="submit" class="btn btn-sm btn-primary btn-active-light-primary">
                                Guardar
                            </button>
                        </td>
                </form>
            @endif
        </tbody>
    </table>
</div>
