@extends('layouts.app')
@section('title','Criar Autor')
@section('content')

<h2>Criar Autor</h2>
<form action="{{ route('autores.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nacionalidade</label>
        <input type="text" name="nacionalidade" class="form-control">
    </div>
    <button class="btn btn-primary">Salvar</button>
</form>
@endsection
