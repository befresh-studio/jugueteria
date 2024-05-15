@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">{{ __('Filtro') }}</div>
    <div class="card-body">
        <form name="filtrar_proveedores" method="POST" action="{{ route('proveedores.filtrar') }}">
            @csrf
            <input type="text" name="filtro" placeholder="{{ __('Buscar...') }}" value="{{ $filtro ?? '' }}" />
            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-search"></i> {{ __('Filtrar') }}</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">{{ __('Listado de proveedores') }}@if(isset($filtro)) <strong>{{ __('Filtrando por: "' . $filtro . '"') }}</strong>@endif</div>
    <div class="card-body">
        @can('create-proveedor')
            <a href="{{ route('proveedores.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo proveedor') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Nombre') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('CIF') }}</th>
                    <th scope="col">{{ __('Teléfono') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proveedores as $proveedor)
                    <tr>
                        <th scope="row">{{ $proveedor->id }}</th>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->email }}</td>
                        <td>{{ $proveedor->cif }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>
                            <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                                @can('edit-proveedor')
                                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                                @endcan

                                @can('delete-proveedor')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este proveedor?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                                @endcan

                                <span id="pedidos_proveedor" class="btn btn-info btn-sm" data-id="{{ $proveedor->id }}">{{ __('Pedidos recientes') }}</span>
                            </form>
                        </td>
                    </tr>
                    @if($proveedor->compras->count() > 0)
                        <tr class="d-none proveedor_{{ $proveedor->id }}">
                            <td>{{ __('Referencia') }}</td>
                            <td>{{ __('Fecha entrega') }}</td>
                            <td>{{ __('IVA') }}</td>
                            <td>{{ __('Importe total') }}</td>
                            <td>{{ __('Estado actual') }}</td>
                            <td>{{ __('Acciones') }}</td>
                        </tr>
                        @foreach($proveedor->compras->sortByDesc('created_at')->take(3) as $compra)
                            <tr class="d-none proveedor_{{ $proveedor->id }}">
                                <td>{{ $compra->referencia }}</td>
                                <td>{{ \Carbon\Carbon::parse($compra->fecha_entrega)->format('d/m/Y') }}</td>
                                <td>{{ number_format($compra->iva, 2, ',') }}€</td>
                                <td>{{ number_format($compra->importe_total, 2, ',') }}€</td>
                                <td>
                                    <div class="dropdown">
                                        <a id="dropdownEstadoCompra{{ $compra->id }}" class="cambiar-estado dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre="">
                                            <span class="estado" style="background-color:{{ $compra->estados->first()->color }}">{{ $compra->estados->first()->estado }}</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownEstadoCompra{{ $compra->id }}">
                                            @foreach($estados as $estado)
                                                @if($estado->id != $compra->estados->first()->id)
                                                    <a class="dropdown-item" href="{{ route('compras.cambiarEstado', ['compra' => $compra, 'id_estado' => $estado->id])}}">{{ $estado->estado }}</a>
                                                @else
                                                    <span class="dropdown-item disabled">{{ $estado->estado }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('compras.destroy', $compra->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                                        @can('edit-compra')
                                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                                        @endcan

                                        @can('delete-compra')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta compra?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay proveedores') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $proveedores->links() }}

    </div>
</div>
@endsection

@section('javascript')
    <script>
        window.onload = function(){
            $("#pedidos_proveedor").on('click', function() {
                var id_proveedor = $(this).data('id');
                $(".proveedor_" + id_proveedor).toggleClass('d-none');
            });
        };
    </script>
@endsection