@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">{{ __('Filtro') }}</div>
    <div class="card-body">
        <form name="filtrar_ventas" method="POST" action="{{ route('ventas.filtrar') }}">
            @csrf
            <input type="text" name="filtro" placeholder="{{ __('Buscar...') }}" value="{{ $filtro ?? '' }}" />
            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-search"></i> {{ __('Filtrar') }}</button>
        </form>
    </div>
</div>

<a href="{{ route('estado-ventas.index') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-flag-fill"></i> {{ __('Ver estados de ventas') }}</a>

<div class="card">
    <div class="card-header">{{ __('Listado de ventas') }}</div>
    <div class="card-body">
        @can('create-venta')
            <a href="{{ route('ventas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva venta') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Referencia') }}</th>
                    <th scope="col">{{ __('Cliente') }}</th>
                    <th scope="col">{{ __('IVA') }}</th>
                    <th scope="col">{{ __('Importe total') }}</th>
                    <th scope="col">{{ __('Estado actual') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas as $venta)
                    <tr>
                        <th scope="row">{{ $venta->id }}</th>
                        <td>{{ $venta->referencia }}</td>
                        <td>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</td>
                        <td>{{ number_format($venta->iva, 2, ',') }}€</td>
                        <td>{{ number_format($venta->importe_total, 2, ',') }}€</td>
                        <td>
                            <div class="dropdown">
                                <a id="dropdownEstadoVenta{{ $venta->id }}" class="cambiar-estado dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre="">
                                    <span class="estado" style="background-color:{{ $venta->estados->first()->color }}">{{ $venta->estados->first()->estado }}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownEstadoVenta{{ $venta->id }}">
                                    @foreach($estados as $estado)
                                        @if($estado->id != $venta->estados->first()->id)
                                            <a class="dropdown-item" href="{{ route('ventas.cambiarEstado', ['venta' => $venta, 'id_estado' => $estado->id])}}">{{ $estado->estado }}</a>
                                        @else
                                            <span class="dropdown-item disabled">{{ $estado->estado }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                                @can('edit-venta')
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                                @endcan

                                @can('delete-venta')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta venta?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay ventas') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $ventas->links() }}

    </div>
</div>
@endsection