@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información de la venta') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                    
                    <div class="row">
                        <label for="cliente" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Cliente') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Referencia') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $venta->referencia }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="iva" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('IVA') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $venta->iva }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $venta->importe_total }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection