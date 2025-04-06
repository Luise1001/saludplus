<form action="{{ route('reservation.reserve') }}" class="form mb-15" method="post" id="kt_careers_form">
    @csrf

    <div class="row mb-5">
        <div class="fv-row col-md-6">
            <label for="patient_id" class="form-label required fs-5 fw-semibold mb-2">Paciente</label>
            <select name="patient_id" class="form-select form-select-solid">
                @if (isset($patient))
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 fv-row">
            <label for="medical_center_id" class="form-label required fs-5 fw-semibold mb-2">Centro médico</label>
            <select wire:model="medical_center_id" wire:change="MedicalCenter()" name="medical_center_id"
                class="form-select form-select-solid">
                <option value="">Seleccionar</option>
                @if (isset($centers) && $centers->count() > 0)
                    @foreach ($centers as $row)
                        <option value="{{ $row->id }}">
                            {{ ucwords($row->short_name) }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 fv-row">
            <label for="medical_area_id" class="form-label required fs-5 fw-semibold mb-2">Área de atención</label>
            <select wire:model="medical_area_id" wire:change="MedicalArea()" name="medical_area_id"
                class="form-select form-select-solid">
                <option value="">Seleccionar</option>
                @if (isset($areas) && $areas->count() > 0)
                    @foreach ($areas as $row)
                        <option value="{{ $row->id }}">
                            {{ ucwords($row->name) }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 fv-row">
            <label form="doctor_id" class="form-label required fs-5 fw-semibold mb-2">Especialista</label>
            <select name="doctor_id" class="form-select form-select-solid">
                <option value="">Seleccionar</option>
                @if (isset($doctors) && $doctors->count() > 0)
                    @foreach ($doctors as $row)
                        <option value="{{ $row->id }}">
                            {{ ucwords("$row->name $row->last_name") }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 fv-row">
            <label for="reason" class="form-label required fs-5 fw-semibold mb-2">Motivo</label>
            <input type="text" class="form-control form-control-solid" placeholder="Motivo de la cita"
                name="reason" />
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 fv-row">
            <label for="date" class="form-label required fs-5 fw-semibold mb-2">Fecha</label>
            <input wire:model="date" wire:change="MedicalSchedule()" type="text" id="calendar" class="form-control form-control-solid cursor-pointer"
                placeholder="Seleccione una fecha" name="date" autocomplete="off" />
        </div>

        <div class="col-md-6 fv-row">
            <label for="medical_schedule_id" class="form-label required fs-5 fw-semibold mb-2">Hora</label>
            <select class="form-select form-select-solid" name="medical_schedule_id">
                <option value="">Seleccionar</option>
                @if (isset($schedules) && $schedules->count() > 0)
                    @foreach ($schedules as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->hour }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    <div class="row mb-5">
        <div class="d-flex flex-column mb-5">
            <label for="observation" class="form-label fs-5 fw-semibold mb-2">Observación</label>
            <textarea class="form-control form-control-solid" rows="4" name="observation"
                placeholder="Por favor indique si tiene alguna condición especial como alergias."></textarea>
        </div>
    </div>

    <div class="separator mb-8"></div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" id="kt_careers_submit_button">
            Enviar
        </button>
    </div>
</form>
