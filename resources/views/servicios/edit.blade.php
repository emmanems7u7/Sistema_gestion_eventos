@extends('layouts.argon')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">
            <div class="container">
                <h2>{!! __('ui.edit') !!} {{ __('lo.servicio') }}</h2>
                <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @include('servicios._form', ['servicio' => $servicio])
                </form>
            </div>
        </div>
    </div>
@endsection