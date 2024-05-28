@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Información de la reserva') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('reservas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="cliente" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Cliente') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellidos }}
                    </div>
                </div>
                
                <div class="row">
                    <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ number_format($reserva->importe_total, 2, ',') }}€
                    </div>
                </div>

                <div class="row">
                    <label for="importe_pagado" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe pagado') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ number_format($reserva->importe_pagado, 2, ',') }}€
                    </div>
                </div>

                <div class="row">
                    <label for="importe_pendiente" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe pendiente') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ number_format($reserva->importe_total - $reserva->importe_pagado, 2, ',') }}€
                    </div>
                </div>

                <div class="row">
                    <label for="comentarios" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Comentarios') }}:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $reserva->comentarios }}
                    </div>
                </div>
        
            </div>
        </div>
    </div>    
</div>

<div class="row justify-content-center mt-4">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Juguetes en la reserva') }}
                </div>
            </div>
            <div class="card-body">
                    
                @foreach($reserva->juguetes as $juguete)
                    @if($loop->index > 0)
                        <hr />
                    @endif
                    
                    <div class="row">
                        <label for="juguete_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Juguete') }} {{ ($loop->index + 1) }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->nombre }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="cantidad_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Cantidad') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $juguete->pivot->cantidad }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="precio_unitario_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Precio unitario') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ number_format($juguete->pivot->precio_unitario, 2, ',') }}€
                        </div>
                    </div>

                    <div class="row">
                        <label for="iva_total_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('IVA total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ number_format($juguete->pivot->iva_total, 2, ',') }}€
                        </div>
                    </div>

                    <div class="row">
                        <label for="importe_total_{{ ($loop->index + 1) }}" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ number_format($juguete->pivot->importe_total, 2, ',') }}€
                        </div>
                    </div>
                @endforeach
        
            </div>
        </div>
    </div>    
</div>
    
@endsection