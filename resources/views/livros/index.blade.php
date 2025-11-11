@extends('layouts.app')
@section('title','Livros')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Livros</h2>
    <a href="{{ route('livros.create') }}" class="btn btn-sm btn-success">Novo Livro</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Disponível</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($livros as $livro)
        <tr>
            <td>{{ $livro->titulo }}</td>
            <td>{{ $livro->autor->nome ?? '—' }}</td>
            <td>{{ $livro->categoria->nome ?? '—' }}</td>
            <td>{{ $livro->quantidade_disponivel }} / {{ $livro->quantidade_total }}</td>
            <td>
                <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-sm btn-primary">Editar</a>
                <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $livros->links() }}
@endsection
