@extends('dash')

@section('content')



    <div class="container-fluid mt-3">

        <div class="card mb-3">
            <div class="card-body">
                <h3>Crear Nueva Solicitud</h3>

            </div>

        </div>
        <form action="{{ route('solicitudes.store_cliente') }}" method="POST">
            @include('solicitudes._form_')
        </form>
    </div>
@endsection