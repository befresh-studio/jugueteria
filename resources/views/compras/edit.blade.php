@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    {{ __('Editar compra') }}
                </div>
                <div class="float-end">
                    <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm">&larr; {{ __('Volver') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('compras.update', $compra->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="proveedor" class="col-md-4 col-form-label text-md-end text-start">{{ __('Proveedor') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('proveedores_id') is-invalid @enderror" id="proveedor" name="proveedores_id">
                                <option value="">{{ __('Seleccione un proveedor') }}</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}"{{ ($proveedor->id == $compra->proveedor->id ? ' selected' : '') }}>{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('proveedores_id'))
                                <span class="text-danger">{{ $errors->first('proveedores_id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-end text-start">{{ __('Referencia') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('referencia') is-invalid @enderror" id="referencia" name="referencia" value="{{ $compra->referencia }}">
                            @if ($errors->has('referencia'))
                                <span class="text-danger">{{ $errors->first('referencia') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="fecha_entrega" class="col-md-4 col-form-label text-md-end text-start">{{ __('Fecha de entrega') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('fecha_entrega') is-invalid @enderror" id="fecha_entrega" name="fecha_entrega" value="{{ $compra->fecha_entrega }}">
                            @if ($errors->has('fecha_entrega'))
                                <span class="text-danger">{{ $errors->first('fecha_entrega') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="iva_aplicado" class="col-md-4 col-form-label text-md-end text-start">{{ __('% IVA') }}</label>
                        <div class="col-md-6">
                            <select class="form-control @error('iva_aplicado') is-invalid @enderror" id="iva_aplicado" name="iva_aplicado">
                                @foreach($ivas as $iva)
                                    <option value="{{ $iva->value }}"{{ (($compra->importe_total - $compra->iva) == ($compra->importe_total / ((100 / $iva->value) + 1)) ? ' selected' : '') }}>{{ $iva->value }}%</option>
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
                          <input type="text" class="form-control decimal @error('iva') is-invalid @enderror" id="iva" name="iva" value="{{ $compra->iva }}">
                            @if ($errors->has('iva'))
                                <span class="text-danger">{{ $errors->first('iva') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="importe_total" class="col-md-4 col-form-label text-md-end text-start">{{ __('Importe total') }}</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control decimal @error('importe_total') is-invalid @enderror" id="importe_total" name="importe_total" value="{{ $compra->importe_total }}">
                            @if ($errors->has('importe_total'))
                                <span class="text-danger">{{ $errors->first('importe_total') }}</span>
                            @endif
                        </div>
                    </div>

                    <div id="juguetes">
                        <h3>{{ __('Juguetes') }}</h3>
                        <hr />
                        @foreach($compra->juguetes as $juguete_compra)
                            <div id="juguete{{ $loop->index + 1 }}">
                                <h5>{{ __('Juguete ') }}{{ $loop->index + 1 }}</h5>
                                <div class="mb-3 row">
                                    <label for="juguete_{{ $loop->index + 1 }}" class="col-md-4 col-form-label text-md-end text-start">{{ __('Juguete') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control juguetes @error('juguetes') is-invalid @enderror" id="juguete_{{ $loop->index + 1 }}" name="juguetes[]">
                                            <option value="">{{ __('Seleccione un juguete') }}</option>
                                            @foreach($compra->proveedor->juguetes as $juguete)
                                                @if($juguete->stock > 0)
                                                    <option data-precio="{{ $juguete->precio }}" value="{{ $juguete->id }}"{{ ($juguete->id == $juguete_compra->id ? ' selected' : '') }}>{{ $juguete->nombre }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="precio_unitario_{{ $loop->index + 1 }}" class="col-md-4 col-form-label text-md-end text-start">{{ __('Precio ud.') }}</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control decimal precio_unitario @error('precio_unitario') is-invalid @enderror" id="precio_unitario_{{ $loop->index + 1 }}" name="precio_unitario[]" value="{{ $juguete_compra->pivot->precio_unitario }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="cantidad_{{ $loop->index + 1 }}" class="col-md-4 col-form-label text-md-end text-start">{{ __('Cantidad') }}</label>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control cantidad @error('cantidad') is-invalid @enderror" id="cantidad_{{ $loop->index + 1 }}" name="cantidad[]" value="{{ $juguete_compra->pivot->cantidad }}">
                                    </div>
                                    <div class="col-md-2">
                                        <button data-num-juguete="{{ $loop->index + 1 }}" class="btn btn-danger btn-sm quitar" onclick="return confirm('{{ __('¿Quieres quitar este juguete?') }}');"><i class="bi bi-trash"></i> {{ __('Quitar') }}</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="#" id="add_juguete" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Añadir juguete') }}</a>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="{{ __('Actualizar') }}">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input.datepicker");
    </script>
@endpush

@section('javascript')
    <script>
        var juguetes = 0;
        var id_proveedor = 0;

        function actualizarImportes() {
            var iva_aplicado = $("#iva_aplicado").val();
            var iva = 0;
            var importe_total = 0;

            $("select.juguetes").each(function() {
                var num_juguete = $(this).prop('id');
                var cantidad = $("#cantidad" + num_juguete.substring(num_juguete.indexOf('_'))).val();
                var precio = $("#precio_unitario" + num_juguete.substring(num_juguete.indexOf('_'))).val();

                iva += (precio * (iva_aplicado / 100) * cantidad);
                importe_total += (precio * (iva_aplicado / 100 + 1) * cantidad);
            });

            $("#iva").val(iva.toFixed(2));
            $("#importe_total").val(importe_total.toFixed(2));
        }

        window.onload = function(){
            $("#proveedor").on('change', function() {
                id_proveedor = $("#proveedor option:selected").val();

                if(id_proveedor > 0)
                    $("#add_juguete").removeClass('d-none');
                else
                $("#add_juguete").addClass('d-none');
            });

            $("#add_juguete").on('click', function(e) {
                e.preventDefault();

                $("#proveedor").css('pointer-events', 'none');

                juguetes++;
                $.get("/compras/add_juguete/" + juguetes + "/" + id_proveedor , function( data ) {
                    $("#juguetes").append(data);
                    
                    $(".quitar").on('click', function() {
                        $("#juguete" + $(this).data('num-juguete')).remove();
                    });

                    $("input.decimal").on("change", function () {
                        $(this).val(Number($(this).val().replace(",", ".")).toFixed(2));
                    });

                    $("select.juguetes, input.cantidad, input.precio_unitario").on('change', function() {
                        actualizarImportes();
                    });
                });
            });

            $("select.juguetes, #iva_aplicado, input.cantidad").on('change', function() {
                actualizarImportes();
            });

            $(".quitar").on('click', function() {
                $("#juguete" + $(this).data('num-juguete')).remove();
            });
        };
    </script>
@endsection