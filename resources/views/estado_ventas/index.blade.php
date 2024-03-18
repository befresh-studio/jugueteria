@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de estados de ventas') }}</div>
    <div class="card-body">
        @can('create-estado_venta')
            <a href="{{ route('estado-ventas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo estado de venta') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Estado') }}</th>
                    <th scope="col">{{ __('Color') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estado_ventas as $estado_venta)
                <tr>
                    <th scope="row">{{ $estado_venta->id }}</th>
                    <td>{{ $estado_venta->estado }}</td>
                    <td>{{ $estado_venta->color }}</td>
                    <td>
                        <form action="{{ route('estado-ventas.destroy', $estado_venta->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('estado-ventas.show', $estado_venta->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-estado_venta')
                                <a href="{{ route('estado-ventas.edit', $estado_venta->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-estado_venta')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este estado de venta?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>{{ __('No hay estados de venta') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $estado_ventas->links() }}

    </div>
</div>
@endsection