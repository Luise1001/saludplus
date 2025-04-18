<div class="modal fade" tabindex="-1" id="modal_filters">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning">Filtrar citas</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <div class="modal-body">
                <form action="{{ route('patient.reservation.history.filter') }}" method="GET">
                    @csrf
                    <label for="date" class="form-label required text-warning fw-bold">Fecha</label>
                    <input class="form-control form-control-solid" name="date" placeholder="Rango de fecha"
                        id="date" value="{{ $date ?? '' }}" />

                    <label for="medical_area_id" class="form-label required text-warning fw-bold">Área de
                        atención</label>
                    <select name="medical_area_id" class="form-select form-select-solid" data-control="select2" 
                    data-bs-placeholder="Seleccionar" data-hide-search="true">
                        <option value="">Seleccionar</option>

                        @if (isset($areas) && $areas->count() > 0)
                            @foreach ($areas as $row)
                                <option value="{{ $row->id }}">{{ $row->name }} </option>
                            @endforeach
                        @endif
                    </select>


                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-active-light-warning mt-2">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
