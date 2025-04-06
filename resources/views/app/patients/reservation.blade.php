@extends('app.layouts.index')

@section('styles')
    @livewireStyles()
    <style>
        .flatpickr-disabled {
            background-color: rgb(246, 74, 74) !important;
        }
    </style>
@endsection

@section('sidebar')
    @include('app.layouts.components.sidebar')
@endsection

@section('header')
    @include('app.layouts.components.navbar')
@endsection


@section('content')
    @include('app.layouts.components.alerts')

    <div id="kt_app_content" class="app-content flex-column-fluid mt-3">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body">

                    <div class="position-relative mb-5">
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

                    <div class="d-flex flex-column flex-lg-row mb-5">
                        <div class="flex-lg-row-fluid me-0 me-lg-20">
                            @livewire('app.patients.reservation-form', ['patient' => $patient])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @livewireScripts()
    <script>
        const calendar = document.getElementById('calendar');
        const today = new Date();
        const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        const lastDayOfNextMonth = new Date(today.getFullYear(), today.getMonth() + 2, 0);
        let availableDates = [];

        Livewire.on('datePicker', (dates) => {
            availableDates = dates[0][0];
            initDate(lastDayOfNextMonth, availableDates);
        });

        calendar.setAttribute('readonly', true);


        function initDate(lastDayOfNextMonth, availableDates) {
            calendar.removeAttribute('readonly');
            calendar.setAttribute('placeholder', 'Seleccione una fecha');
            calendar.setAttribute('autocomplete', 'off');

            flatpickr("#calendar", {
                mode: "single",
                dateFormat: "Y-m-d",
                minDate: "today",
                maxDate: lastDayOfNextMonth,
                disable: [
                    function(date) {
                        return true;
                    }
                ],
                enable: availableDates,
                onDayCreate: function(dObj, dStr, dFrag, dayObj) {
                    if (availableDates.includes(dayObj.dateStr)) {
                        dayObj.classList.add('disabled-date');
                    }
                },
            });
        }
    </script>
@endsection
