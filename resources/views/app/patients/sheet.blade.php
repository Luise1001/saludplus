@extends('app.layouts.index')

@section('styles')
@endsection

@section('sidebar')
    @include('app.layouts.components.sidebar')
@endsection

@section('header')
    @include('app.layouts.components.navbar')
@endsection



@section('content')
    @include('app.layouts.components.alerts')

    <div class="card p-5 m-5 mb-5 mb-xl-5">
        <div class="card-header border-0">
            <div class="card-title">
                <h2 class="fw-bold mb-0">Comprobante de cita</h2>
            </div>
        </div>

        <div id="kt_customer_view" class="card-body pt-0">
            <div class="py-0" data-kt-customer-payment-method="row">
                <div class="py-3 d-flex flex-stack flex-wrap">
                    <div class="d-flex align-items-center collapsible rotate">

                        <img src="{{ asset('assets/media/svg/card-logos/mastercard.svg') }}" class="w-40px me-3"
                            alt="" />

                        <div class="me-3">
                            <div class="d-flex align-items-center">
                                <div class="text-gray-800 fw-bold">{{ ucwords($reservation->MedicalCenter->name) }} </div>
                            </div>
                            <div class="text-muted">
                                {{ $reservation->MedicalCenter->state->name }}
                                {{ $reservation->MedicalCenter->municipality->name }}
                                {{ $reservation->MedicalCenter->parish->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div id="kt_customer_view_1" class="collapse show fs-6 ps-10" data-bs-parent="#kt_customer_view">
                    <div class="d-flex flex-wrap py-5">
                        <div class="flex-equal me-5">
                            <table class="table table-flush fw-semibold gy-1">
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Nombre</td>
                                    <td class="text-gray-800">
                                        {{ ucwords($reservation->patient->name) }}
                                        {{ ucwords($reservation->patient->last_name) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Cédula</td>
                                    <td class="text-gray-800">{{ $reservation->patient->document }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Teléfono</td>
                                    <td class="text-gray-800">{{ $reservation->patient->phone }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Edad</td>
                                    <td class="text-gray-800">{{ $reservation->patient->age }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Dirección</td>
                                    <td class="text-gray-800">
                                        {{ $reservation->patient->state->name }}
                                        {{ $reservation->patient->municipality->name }}
                                        {{ $reservation->patient->parish->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Sector</td>
                                    <td class="text-gray-800">
                                        {{ $reservation->patient->sector }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="flex-equal">
                            <table class="table table-flush fw-semibold gy-1">
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Área de atención</td>
                                    <td class="text-gray-800">{{ ucwords($reservation->MedicalArea->name) }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Especialista</td>
                                    <td class="text-gray-800">
                                        {{ $reservation->doctor->name }}
                                        {{ $reservation->doctor->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Fecha</td>
                                    <td class="text-gray-800">{{ date('d-m-Y', strtotime($reservation->date)) }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Día</td>
                                    <td class="text-gray-800">{{ $reservation->MedicalSchedule->day }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Hora</td>
                                    <td class="text-gray-800">{{ date('h:i A', strtotime($reservation->MedicalSchedule->hour)) }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Observación</td>
                                    <td class="text-gray-800">{{ $reservation->observation }} </td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Estatus</td>
                                    <td class="text-gray-800">{{ ucfirst($reservation->status) }} </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
