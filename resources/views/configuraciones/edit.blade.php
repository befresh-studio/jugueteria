@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Editar valor de configuración') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('configuraciones.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('configuraciones.update', $configuracion->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3 row">
                        <label for="key" class="col-md-4 col-form-label text-md-end text-start">{{ __('Clave') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ $configuracion->key }}">
                            @if ($errors->has('key'))
                                <span class="text-danger">{{ $errors->first('key') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="value" class="col-md-4 col-form-label text-md-end text-start">{{ __('Valor') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ $configuracion->value }}">
                            @if ($errors->has('value'))
                                <span class="text-danger">{{ $errors->first('value') }}</span>
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