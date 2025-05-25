@extends('layouts.argon')

@section('content')

    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">

            <h1>Crear Nueva Solicitud</h1>

            <form action="{{ route('solicitudes.store') }}" method="POST">
                @include('solicitudes._form')
            </form>
        </div>
    </div>

@endsection