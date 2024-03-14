@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de estados de compras') }}</div>
    <div class="card-body">
        @can('create-estado_compra')
            <a href="{{ route('estado_compras.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo estado de compra') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Nombre') }}</th>
                    <th scope="col">{{ __('Color') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($estado_compras as $estado_compra)
                <tr>
                    <th scope="row">{{ $estado_compra->id }}</th>
                    <td>{{ $estado_compra->nombre }}</td>
                    <td>{{ $estado_compra->color }}</td>
                    <td>
                        <form action="{{ route('estado_compras.destroy', $estado_compra->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('estado_compras.show', $estado_compra->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-estado_compra')
                                <a href="{{ route('estado_compras.edit', $estado_compra->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-estado_compra')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este estado de compra?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>{{ __('No hay estados de compras') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $estado_compras->links() }}

    </div>
</div>
@endsection