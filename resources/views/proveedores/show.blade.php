@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información del proveedor') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('proveedores.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                    
                <div class="row">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Nombre') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $proveedor->nombre }}
                    </div>
                </div>

                <div class="row">
                    <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Email') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $proveedor->email }}
                    </div>
                </div>

                <div class="row">
                    <label for="cif" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('CIF') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $proveedor->cif }}
                    </div>
                </div>

                <div class="row">
                    <label for="telefono" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Teléfono') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $proveedor->telefono }}
                    </div>
                </div>

                <div class="row">
                    <label for="observaciones" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Observaciones') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $proveedor->observaciones }}
                    </div>
                </div>
        
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Juguetes del proveedor') }}
                </div>
            </div>
            <div class="card-body">
                    
                @foreach($proveedor->juguetes as $juguete)
                    <div class="row">
                        <label for="juguete_{{ $loop->index }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Juguete') }} {{ $loop->index + 1 }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->nombre }}
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
    </div>    
</div>
    
@endsection