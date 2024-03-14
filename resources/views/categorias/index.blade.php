@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de categorías') }}</div>
    <div class="card-body">
        @can('create-categoria')
            <a href="{{ route('categorias.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nueva categoría') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Nombre') }}</th>
                    <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                <tr>
                    <th scope="row">{{ $categoria->id }}</th>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-categoria')
                                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-categoria')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar esta categoría?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>{{ __('No hay categorías') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $categorias->links() }}

    </div>
</div>
@endsection