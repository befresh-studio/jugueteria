@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">{{ __('Filtro') }}</div>
    <div class="card-body">
        <form name="filtrar_compras" method="POST" action="{{ route('compras.filtrar') }}">
            @csrf
            <input type="text" name="filtro" placeholder="{{ __('Buscar...') }}" value="{{ $filtro ?? '' }}" />
            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-search"></i> {{ __('Filtrar') }}</button>
        </form>
    </div>
</div>

<a href="{{ route('estado-compras.index') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-flag-fill"></i> {{ __('Ver estados de compras') }}</a>

<div class="card">
    <div class="card-header">{{ __('Listado de compras') }}</div>
    <div class="card-body">
        @can('create-compra')
            <a href="{{ route('compras.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva compra') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Referencia') }}</th>
                    <th scope="col">{{ __('Proveedor') }}</th>
                    <th scope="col">{{ __('Fecha entrega') }}</th>
                    <th scope="col">{{ __('IVA') }}</th>
                    <th scope="col">{{ __('Importe total') }}</th>
                    <th scope="col">{{ __('Estado actual') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($compras as $compra)
                <tr>
                    <th scope="row">{{ $compra->id }}</th>
                    <td>{{ $compra->referencia }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
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
                @empty
                    <td colspan="7">
                        <span class="text-danger">
                            <strong>{{ __('No hay compras') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $compras->links() }}

    </div>
</div>
@endsection