@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información del estado de venta') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('estado-ventas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                    
                    <div class="row">
                        <label for="estado" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Estado') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $estado_venta->estado }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="color" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Color') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $estado_venta->color }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection