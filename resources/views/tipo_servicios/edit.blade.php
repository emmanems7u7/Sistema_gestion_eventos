@extends('layouts.argon')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <p>Editar Tipo de Servicio</p>
            <form action="{{ route('tipo_servicios.update', $tipoServicio->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('tipo_servicios._form')
            </form>
        </div>
    </div>
@endsection