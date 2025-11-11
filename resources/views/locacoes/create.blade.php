@extends('layouts.app')

@section('title','Criar Locação')

@section('content')
<h2>Nova Locação</h2>
<form action="{{ route('locacoes.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label class="form-label">Usuário</label>
    <select name="usuario_id" class="form-control" required>
      <option value="">-- selecione --</option>
      @foreach($usuarios as $u)
        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Livro</label>
    <select name="livro_id" class="form-control" required>
      <option value="">-- selecione --</option>
      @foreach($livros as $l)
        <option value="{{ $l->id }}">{{ $l->titulo }} ({{ $l->quantidade_disponivel }} disponíveis)</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Data prevista de devolução</label>
    <input type="date" name="data_devolucao" class="form-control" required>
  </div>

  <button class="btn btn-primary">Criar Locação</button>
</form>
@endsection
