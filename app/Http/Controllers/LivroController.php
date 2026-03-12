<?php

namespace App\Http\Controllers;

use App\Http\Requests\Livro\LivroRequest;
use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Livro;

class LivroController extends Controller
{
    public function index()
    {
        $livros = Livro::with(['autor','categoria'])->paginate(10);
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::all();
        $categorias = Categoria::all();
        return view('livros.create', compact('autores','categorias'));
    }

    public function store(LivroRequest $request)
    {
        $data = $request->validated();

        $data['quantidade_disponivel'] = $data['quantidade_total'];
        Livro::create($data);
        return redirect()->route('livros.index')->with('success', 'Livro criado.');
    }

    public function show(Livro $livro)
    {
        $livro->load(['autor', 'categoria', 'locacoes.usuario']);
        return view('livros.show', compact('livro'));
    }

    public function edit(Livro $livro)
    {
        $autores = Autor::all();
        $categorias = Categoria::all();
        return view('livros.edit', compact('livro', 'autores', 'categorias'));
    }

    public function update(LivroRequest $request, Livro $livro)
    {
        $data = $request->validated();
        $diff = $data['quantidade_total'] - $livro->quantidade_total;
        $data['quantidade_disponivel'] = max(0, $livro->quantidade_disponivel + $diff);

        $livro->update($data);
        return redirect()->route('livros.index')->with('success', 'Livro atualizado.');
    }

    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro removido.');
    }
}
