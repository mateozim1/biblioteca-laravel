@extends('layouts.app')
@section('title','Categorias')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Categorias</h2>
  <a href="{{ route('categorias.create') }}" class="btn btn-sm btn-success">Nova Categoria</a>
</div>

<table class="table table-striped">
    <thead><tr><th>Nome</th><th>Descrição</th><th></th></tr></thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->nome }}</td>
            <td>{{ $categoria->descricao }}</td>
            <td>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-primary">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $categorias->links() }}
@endsection
