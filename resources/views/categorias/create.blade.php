@extends('layouts.app')
@section('title','Criar Categoria')
@section('content')

<h2>Criar Categoria</h2>
<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Salvar</button>
</form>
@endsection
