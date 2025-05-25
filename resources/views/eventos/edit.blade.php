@extends('layouts.argon')

@section('content')

    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">
            <h1>Editar Evento</h1>

            <form action="{{ route('eventos.update', $evento) }}" method="POST">
                @include('eventos._form')
            </form>
        </div>
    </div>


@endsection