@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información de la categoría') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('categorias.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Nombre') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $categoria->nombre }}
                    </div>
                </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection