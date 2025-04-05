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
    @livewire('app.patients.date-reserve')
@endsection

@include('app.layouts.components.alerts')

@section('scripts')
    @livewireScripts()
    <script>
        let availableDates = ["2025-04-15", "2025-04-20", "2025-04-25"];

        flatpickr("#calendar", {
            mode: "single",
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: availableDates,
            onDayCreate: function(dObj, dStr, dFrag, dayObj) {
                if (availableDates.includes(dayObj.dateStr)) {
                    dayObj.classList.add('disabled-date');
                }
            },
            onChange: function(selectedDates, dateStr, instance) {
                // set hour options based on selected date
            }
        });
    </script>
@endsection
