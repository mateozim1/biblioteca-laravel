@extends('layouts.app')

@section('title','Criar Livro')

@section('content')
<h2>Criar Livro</h2>
<form action="{{ route('livros.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Título</label>
    <input type="text" name="titulo" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Autor</label>
    <select name="autor_id" class="form-control" required>
      <option value="">-- selecione --</option>
      @foreach($autores as $autor)
        <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Categoria</label>
    <select name="categoria_id" class="form-control" required>
      <option value="">-- selecione --</option>
      @foreach($categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Ano de publicação</label>
    <input type="number" name="ano_publicacao" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Quantidade total</label>
    <input type="number" name="quantidade_total" class="form-control" required min="0">
  </div>

  <div class="mb-3">
    <label class="form-label">ISBN</label>
    <input type="text" name="isbn" class="form-control">
  </div>

  <button class="btn btn-primary">Salvar</button>
</form>
@endsection
