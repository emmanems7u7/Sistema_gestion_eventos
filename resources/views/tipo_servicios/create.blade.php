@extends('layouts.argon')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <p>Crear Tipo de Servicio</p>
            <form action="{{ route('tipo_servicios.store') }}" method="POST">
                @csrf
                @include('tipo_servicios._form')
            </form>
        </div>
    </div>
@endsection