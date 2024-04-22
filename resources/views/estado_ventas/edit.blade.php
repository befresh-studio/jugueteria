@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Editar estado de venta') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('estado-ventas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('estado-ventas.update', $estado_venta->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3 row">
                        <label for="estado" class="col-md-4 col-form-label text-md-end text-start">{{ __('Estado') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" value="{{ $estado_venta->estado }}">
                            @if ($errors->has('estado'))
                                <span class="text-danger">{{ $errors->first('estado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="color" class="col-md-4 col-form-label text-md-end text-start">{{ __('Color') }}</label>
                        <div class="col-md-6">
                          <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" id="color" name="color" value="{{ $estado_venta->color }}" title="{{ __('Elige un color')}}">
                            @if ($errors->has('color'))
                                <span class="text-danger">{{ $errors->first('color') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Actualizar') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection