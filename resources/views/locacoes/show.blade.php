@extends('layouts.app')

@section('title','Detalhes da Locação')

@section('content')
<h2>Locação #{{ $locacao->id }}</h2>
<p><strong>Usuário:</strong> {{ $locacao->usuario->name ?? '—' }}</p>
<p><strong>Livro:</strong> {{ $locacao->livro->titulo ?? '—' }}</p>
<p><strong>Data locação:</strong> {{ $locacao->data_locacao }}</p>
<p><strong>Data devolução:</strong> {{ $locacao->data_devolucao }}</p>
<p><strong>Status:</strong> {{ $locacao->status }}</p>

<a href="{{ route('locacoes.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
