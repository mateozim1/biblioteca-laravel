<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Categoria::create($data);
        return redirect()->route('categorias.index')->with('success', 'Categoria criada.');
    }

    public function show($id)
    {
        $categoria = Categoria::with('livros')->findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);
        $categoria->update($data);
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada.');
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria removida.');
    }
}
