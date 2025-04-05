@extends('app.layouts.index')

@section('styles')
@endsection

@section('sidebar')
    @include('app.layouts.components.sidebar')
@endsection

@section('header')
    @include('app.layouts.components.navbar')
@endsection


@include('app.layouts.components.alerts')

@section('content')
    <div class="card p-5 m-5 mb-5 mb-xl-5">
        <div class="card-header border-0">
            <div class="card-title">
                <h2 class="fw-bold mb-0">Comprobante</h2>
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
                                <div class="text-gray-800 fw-bold">Centro médico</div>
                            </div>
                            <div class="text-muted">Catia la mar, vista al mar</div>
                        </div>
                    </div>
                </div>

                <div id="kt_customer_view_1" class="collapse show fs-6 ps-10" data-bs-parent="#kt_customer_view">
                    <div class="d-flex flex-wrap py-5">
                        <div class="flex-equal me-5">
                            <table class="table table-flush fw-semibold gy-1">
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Nombre</td>
                                    <td class="text-gray-800">Emma Smith</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Cédula</td>
                                    <td class="text-gray-800">123456789</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Teléfono</td>
                                    <td class="text-gray-800">0414444090</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Edad</td>
                                    <td class="text-gray-800">34</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Dirección</td>
                                    <td class="text-gray-800">Catia la mar edo. vargas</td>
                                </tr>
                            </table>
                        </div>

                        <div class="flex-equal">
                            <table class="table table-flush fw-semibold gy-1">
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Área de atención</td>
                                    <td class="text-gray-800">Odontología</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Especialista</td>
                                    <td class="text-gray-800">Ricardo perez</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Fecha</td>
                                    <td class="text-gray-800">04-04-2025</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Hora</td>
                                    <td class="text-gray-800">1:00 PM</td>
                                </tr>
                                <tr>
                                    <td class="text-muted min-w-125px w-125px">Observación</td>
                                    <td class="text-gray-800">Alergia al trabajo</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button class="btn btn-md btn-primary btn-active-light-primary">Descargar</button>
    </div>
@endsection


@section('scripts')
@endsection
