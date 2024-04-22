@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Nueva venta para: ') . $cliente->nombre . ' ' . $cliente->apellidos }}
                </div>
                <div class="float-end">
                    <a href="{{ route('ventas.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('ventas.store') }}" method="post">
                    @csrf
                    
                    <input type="hidden" name="clientes_id" value="{{ $cliente->id }}" />

                    <div class="mb-3 row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start">{{ __('Referencia') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('referencia') is-invalid @enderror" id="referencia" name="referencia" value="{{ old('referencia') }}">
                            @if ($errors->has('referencia'))
                                <span class="text-danger">{{ $errors->first('referencia') }}</span>
                            @endif
                        </div>
                    </div>

                    <div id="juguetes">
                        <h3>{{ __('Juguetes') }}</h3>
                        <div class="mb-3 row">
                            <label for="ref_juguete" class="col-md-4 col-form-label text-md-end text-start">{{ __('Ref Juguete') }}</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" id="ref_juguete" name="ref_juguete" >
                            </div>
                        </div>
                        <hr />
                    </div>

                    <div class="mb-3 row">
                        <label for="iva_aplicado" class="col-md-4 col-form-label text-md-end text-start">{{ __('% IVA') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('iva_aplicado') is-invalid @enderror" id="iva_aplicado" name="iva_aplicado">
                                @foreach($ivas as $iva)
                                    <option value="{{ $iva->value }}"{{ ($iva->value == old('iva_aplicado') ? ' selected' : '') }}>{{ $iva->value }}%</option>
                                @endforeach
                            </select>
                            @if ($errors->has('iva_aplicado'))
                                <span class="text-danger">{{ $errors->first('iva_aplicado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="iva" class="col-md-4 col-form-label text-md-end text-start">{{ __('IVA') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('iva') is-invalid @enderror" id="iva" name="iva" value="{{ (old('iva') ?? 0) }}">
                            @if ($errors->has('iva'))
                                <span class="text-danger">{{ $errors->first('iva') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start">{{ __('Importe total') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('importe_total') is-invalid @enderror" id="importe_total" name="importe_total" value="{{ (old('importe_total') ?? 0) }}">
                            @if ($errors->has('importe_total'))
                                <span class="text-danger">{{ $errors->first('importe_total') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Insertar venta') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection

@section('javascript')
    <script>
        var juguetes = 0;

        function actualizarImportes() {
            var iva_aplicado = $("#iva_aplicado").val();
            var iva = 0;
            var importe_total = 0;

            $(".juguete").each(function() {
                var num_juguete = $(this).attr('data-numJuguete');
                var cantidad = $("#cantidad_" + num_juguete).val();
                var precio = $(this).attr('data-precio');

                iva += (precio * (iva_aplicado / 100) * cantidad);
                importe_total += (precio * (iva_aplicado / 100 + 1) * cantidad);
            });

            $("#iva").val(iva.toFixed(2));
            $("#importe_total").val(importe_total.toFixed(2));
        }

        window.onload = function(){
            $("#ref_juguete").on('change', function(e) {
                e.preventDefault();
                    
                var existe = false;
                var ref_juguete = $(this).val();

                if(ref_juguete) {
                    $(".referencia_juguete").each(function() {
                        if($(this).text() == ref_juguete) {
                            $("#cantidad_" + $(this).attr('data-numJuguete')).val(Number.parseInt($("#cantidad_" + $(this).attr('data-numJuguete')).val()) + 1);
                            existe = true;

                            actualizarImportes();

                            $("#ref_juguete").val('');
                        }
                    })

                    if(!existe) {
                        juguetes++;
                        $.ajax({
                            url: "/ventas/add_juguete/" + juguetes,
                            method: "POST",
                            data: { _token : '{{ csrf_token() }}', ref_juguete: $(this).val() },
                            dataType: "json"
                        }).done(function( response ) {
                            if(response.success) {
                                $("#juguetes").append(response.html);
                            
                                $(".quitar").on('click', function() {
                                    $("#juguete" + $(this).data('num-juguete')).remove();
                                });

                                $("input.cantidad").on('change', function() {
                                    actualizarImportes();
                                });

                                actualizarImportes();

                                $("#ref_juguete").val('');
                            } else {
                                juguetes--;
                                alert(response.message);
                            }
                        });
                    }
                }
            });

            $("#iva_aplicado, input.cantidad").on('change', function() {
                actualizarImportes();
            });

            $(".quitar").on('click', function() {
                $("#juguete" + $(this).data('num-juguete')).remove();
            });
        };
    </script>
@endsection