<div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17">

                    <div class="position-relative mb-17">
                        <div class="overlay overlay-show">
                            <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                                style="background-image:url('assets/media/stock/1600x800/img-1.jpg')"></div>
                            <div class="overlay-layer rounded bg-black" style="opacity: 0.4"></div>
                        </div>

                        <div class="position-absolute text-white mb-8 ms-10 bottom-0">
                            <h3 class="text-white fs-2qx fw-bold mb-3 m">Reservación de cita</h3>
                            <div class="fs-5 fw-semibold"></div>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-lg-row mb-17">
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            <form action="{{ route('reservation.reserve') }}" class="form mb-15" method="post"
                                id="kt_careers_form">
                                @csrf
                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-5 fw-semibold mb-2">Centro médico</label>
                                        <select name="medical_center" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Centro médico 1</option>
                                            <option value="2">Centro médico 2</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-5 fw-semibold mb-2">Área de atención</label>
                                        <select name="attention_area" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Área 1</option>
                                            <option value="1">Área 1</option>
                                            <option value="2">Área 2</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-5 fw-semibold mb-2">Especialista</label>
                                        <select name="specialist" class="form-select form-select-solid">
                                            <option value="">Seleccionar</option>
                                            <option value="1">Especialista 1</option>
                                            <option value="2">Especialista 2</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label class="required fs-5 fw-semibold mb-2">Motivo</label>
                                        <input type="text" class="form-control form-control-solid"
                                            placeholder="Motivo" name="reason" />
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-6 fv-row">
                                        <label for="date" class="required fs-5 fw-semibold mb-2">Fecha</label>
                                        <input type="text" id="calendar" class="form-control form-control-solid"
                                            placeholder="Seleccione una fecha" name="date" />
                                    </div>

                                    <div class="col-md-6 fv-row">
                                        <label for="hour" class="required fs-5 fw-semibold mb-2">Hora</label>
                                        <select class="form-select form-select-solid" name="hour">
                                            <option value="">Seleccionar</option>
                                            <option value="1">08:00</option>
                                            <option value="2">09:00</option>
                                            <option value="3">10:00</option>
                                            <option value="4">11:00</option>
                                            <option value="5">12:00</option>
                                            <option value="6">13:00</option>
                                            <option value="7">14:00</option>
                                            <option value="8">15:00</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="d-flex flex-column mb-8">
                                        <label class="fs-6 fw-semibold mb-2">Observación</label>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
