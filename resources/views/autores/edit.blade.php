@extends('layouts.app')

@section('title','Editar Autor')

@section('content')
<h2>Editar Autor</h2>
<form action="{{ route('autores.update', $autor->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" class="form-control" value="{{ $autor->nome }}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Nacionalidade</label>
    <input type="text" name="nacionalidade" class="form-control" value="{{ $autor->nacionalidade }}">
  </div>
  <button class="btn btn-primary">Atualizar</button>
</form>
@endsection
