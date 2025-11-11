@extends('layouts.app')

@section('title','Detalhes do Livro')

@section('content')
<h2>{{ $livro->titulo }}</h2>
<p><strong>Autor:</strong> {{ $livro->autor->nome ?? '—' }}</p>
<p><strong>Categoria:</strong> {{ $livro->categoria->nome ?? '—' }}</p>
<p><strong>Disponível:</strong> {{ $livro->quantidade_disponivel }} / {{ $livro->quantidade_total }}</p>

<h4>Locações</h4>
<table class="table table-sm">
  <thead><tr><th>Usuário</th><th>Data locação</th><th>Data devolução</th><th>Status</th></tr></thead>
  <tbody>
    @foreach($livro->locacoes as $loc)
      <tr>
        <td>{{ $loc->usuario->name ?? '—' }}</td>
        <td>{{ $loc->data_locacao }}</td>
        <td>{{ $loc->data_devolucao }}</td>
        <td>{{ $loc->status }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
