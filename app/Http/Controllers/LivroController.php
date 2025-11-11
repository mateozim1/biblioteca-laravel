<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Categoria;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'ano_publicacao' => 'nullable|integer',
            'quantidade_total' => 'required|integer|min:0',
            'isbn' => 'nullable|string',
        ]);

        $data['quantidade_disponivel'] = $data['quantidade_total'] ?? 0;
        Livro::create($data);
        return redirect()->route('livros.index')->with('success', 'Livro criado.');
    }

    public function show($id)
    {
        $livro = Livro::with(['autor','categoria','locacoes.usuario'])->findOrFail($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id)
    {
        $livro = Livro::findOrFail($id);
        $autores = Autor::all();
        $categorias = Categoria::all();
        return view('livros.edit', compact('livro','autores','categorias'));
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor_id' => 'required|exists:autores,id',
            'categoria_id' => 'required|exists:categorias,id',
            'ano_publicacao' => 'nullable|integer',
            'quantidade_total' => 'required|integer|min:0',
            'isbn' => 'nullable|string',
        ]);

        if (isset($data['quantidade_total'])) {
            $diff = $data['quantidade_total'] - $livro->quantidade_total;
            $livro->quantidade_disponivel = max(0, $livro->quantidade_disponivel + $diff);
        }

        $livro->update($data);
        return redirect()->route('livros.index')->with('success', 'Livro atualizado.');
    }

    public function destroy($id)
    {
        Livro::findOrFail($id)->delete();
        return redirect()->route('livros.index')->with('success', 'Livro removido.');
    }
}
