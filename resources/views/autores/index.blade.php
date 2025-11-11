@extends('layouts.app')

@section('title','Autores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Autores</h2>
  <a href="{{ route('autores.create') }}" class="btn btn-sm btn-success">Novo Autor</a>
</div>

<table class="table table-striped">
  <thead><tr><th>Nome</th><th>Nacionalidade</th><th></th></tr></thead>
  <tbody>
    @foreach($autores as $autor)
    <tr>
      <td>{{ $autor->nome }}</td>
      <td>{{ $autor->nacionalidade }}</td>
      <td>
        <a href="{{ route('autores.edit', $autor->id) }}" class="btn btn-sm btn-primary">Editar</a>
        <form action="{{ route('autores.destroy', $autor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Remover</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $autores->links() }}
@endsection
