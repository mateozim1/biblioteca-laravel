@extends('layouts.app')

@section('title','Home')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Bem-vindo à Biblioteca</h1>
            <p>Últimos livros adicionados:</p>
            <div class="row">
                @foreach($livros as $livro)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $livro->titulo }}</h5>
                            <p class="card-text">{{ $livro->autor->nome ?? '—' }} — {{ $livro->categoria->nome ?? '—' }}</p>
                            <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-sm btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h4>Menu rápido</h4>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('livros.index') }}">Gerenciar Livros</a></li>
                <li class="list-group-item"><a href="{{ route('locacoes.index') }}">Gerenciar Locações</a></li>
            </ul>
        </div>
    </div>
@endsection
