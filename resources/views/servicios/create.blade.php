@extends('layouts.argon')

@section('content')
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body">
            <div class="container">
                <h2>{!! __('ui.create') !!} {{ __('lo.servicio') }}</h2>
                <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data">
                    @include('servicios._form', ['servicio' => null])
                </form>
            </div>
        </div>
    </div>
@endsection