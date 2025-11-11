<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::paginate(10);
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:100',
        ]);

        Autor::create($data);
        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso.');
    }

    public function show($id)
    {
        $autor = Autor::with('livros')->findOrFail($id);
        return view('autores.show', compact('autor'));
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'nullable|string|max:100',
        ]);
        $autor->update($data);
        return redirect()->route('autores.index')->with('success', 'Autor atualizado.');
    }

    public function destroy($id)
    {
        Autor::findOrFail($id)->delete();
        return redirect()->route('autores.index')->with('success', 'Autor removido.');
    }
}
