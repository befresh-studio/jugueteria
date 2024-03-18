@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Listado de juguetes') }}</div>
    <div class="card-body">
        @can('create-juguete')
            <a href="{{ route('juguetes.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> {{ __('Insertar nuevo juguete') }}</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">{{ __('ID') }}</th>
                <th scope="col">{{ __('Categorías') }}</th>
                <th scope="col">{{ __('Imagen') }}</th>
                <th scope="col">{{ __('Nombre') }}</th>
                <th scope="col">{{ __('Referencia') }}</th>
                <th scope="col">{{ __('EAN13') }}</th>
                <th scope="col">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($juguetes as $juguete)
                <tr>
                    <th scope="row">{{ $juguete->id }}</th>
                    <td>@foreach ($juguete->categorias as $categoria) {{ $categoria->nombre }}@if(!$loop->last),@endif @endforeach</th>
                    <td><img src="{{ url('storage/'.$juguete->imagen) }}" alt="{{ $juguete->nombre }}" class="img-fluid img-juguete" /></td>
                    <td>{{ $juguete->nombre }}</td>
                    <td>{{ $juguete->referencia }}</td>
                    <td>{{ $juguete->ean13 }}</td>
                    <td>
                        <form action="{{ route('juguetes.destroy', $juguete->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('juguetes.show', $juguete->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> {{ __('Ver') }}</a>

                            @can('edit-juguete')
                                <a href="{{ route('juguetes.edit', $juguete->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Editar') }}</a>
                            @endcan

                            @can('delete-juguete')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('¿Quieres borrar este juguete?') }}');"><i class="bi bi-trash"></i> {{ __('Borrar') }}</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="6">
                        <span class="text-danger">
                            <strong>{{ __('No hay juguetes') }}</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $juguetes->links() }}

    </div>
</div>
@endsection