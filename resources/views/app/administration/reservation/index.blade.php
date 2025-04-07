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
@endsection


@section('scripts')
@endsection
