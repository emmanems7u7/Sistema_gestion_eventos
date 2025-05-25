@extends('layouts.argon')

@section('content')

    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">
            <h1>Editar Solicitud</h1>

            <form action="{{ route('solicitudes.update', $solicitud) }}" method="POST">
                @include('solicitudes._form')
            </form>
        </div>
    </div>


@endsection