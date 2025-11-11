@extends('layouts.app')

@section('title','Locações')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Locações</h2>
  <a href="{{ route('locacoes.create') }}" class="btn btn-sm btn-success">Nova Locação</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Livro</th>
            <th>Locação</th>
            <th>Devolução</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($locacoes as $loc)
        <tr>
            <td>{{ $loc->usuario->name ?? '—' }}</td>
            <td>{{ $loc->livro->titulo ?? '—' }}</td>
            <td>{{ $loc->data_locacao }}</td>
            <td>{{ $loc->data_devolucao }}</td>
            <td>{{ $loc->status }}</td>
            <td>
                @if($loc->status == 'ativa')
                <form action="{{ route('locacoes.devolver', $loc->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-warning">Devolver</button>
                </form>
                @endif
                <a href="{{ route('locacoes.show', $loc->id) }}" class="btn btn-sm btn-info">Ver</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $locacoes->links() }}
@endsection
