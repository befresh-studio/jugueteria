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
                            {{ number_format($venta->iva, 2, ',') }}€
                        </div>
                    </div>

                    <div class="row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start"><strong>{{ __('Importe total') }}:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ number_format($venta->importe_total, 2, ',') }}€
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
                    {{ __('Historial de estados') }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <form name="cambiarEstado" action="{{ route('ventas.cambiarEstadoPost') }}" method="POST">
                            <input type="hidden" name="id_venta" value="{{ $venta->id }}" />
                            @csrf
                            <div class="form-group d-inline-block">
                                <label for="estado">{{ __('Estado') }}</label>
                                <select name="estado" id="estado" class="form-control d-inline-block" required>
                                    <option value="">{{ __('Selecciona estado') }}</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}"{{ ($estado->id == $venta->estados->first()->id ? 'disabled' : '') }}>{{ $estado->estado }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="submit" value="{{ __('Cambiar estado') }}" class="btn btn-primary" />
                        </form>
                    </div>
                </div>
                    
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('Estado') }}</th>
                                <th scope="col">{{ __('Fecha y hora') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->estados as $estado)
                                <tr>
                                    <td><span class="estado" style="background-color:{{ $estado->color }}">{{ $estado->estado }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($estado->pivot->created_at)->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    {{ __('Juguetes en la venta') }}
                </div>
            </div>
            <div class="card-body">
                    
                @foreach($venta->juguetes as $juguete)
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