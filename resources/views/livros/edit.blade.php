@extends('layouts.app')

@section('title','Editar Livro')

@section('content')
<h2>Editar Livro</h2>
<form action="{{ route('livros.update', $livro->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control" value="{{ $livro->titulo }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Autor</label>
    <select name="autor_id" class="form-control" required>
      @foreach($autores as $autor)
        <option value="{{ $autor->id }}" @if($autor->id == $livro->autor_id) selected @endif>{{ $autor->nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Categoria</label>
    <select name="categoria_id" class="form-control" required>
      @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}" @if($categoria->id == $livro->categoria_id) selected @endif>{{ $categoria->nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Ano de publicação</label>
    <input type="number" name="ano_publicacao" class="form-control" value="{{ $livro->ano_publicacao }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Quantidade total</label>
    <input type="number" name="quantidade_total" class="form-control" value="{{ $livro->quantidade_total }}" required min="0">
  </div>

  <div class="mb-3">
    <label class="form-label">ISBN</label>
    <input type="text" name="isbn" class="form-control" value="{{ $livro->isbn }}">
  </div>

  <button class="btn btn-primary">Atualizar</button>
</form>
@endsection
