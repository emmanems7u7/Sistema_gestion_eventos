@extends('layouts.argon')

@section('content')

    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">

            <h4>Crear Nuevo Evento</h4>

            <form action="{{ route('eventos.store') }}" method="POST">
                @include('eventos._form')
            </form>
        </div>
    </div>

@endsection