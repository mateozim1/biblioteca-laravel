<?php

namespace App\Http\Controllers;

use App\Http\Requests\Autor\AutorRequest;
use App\Models\Autor;

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

    public function store(AutorRequest $request)
    {
        Autor::create($request->validated());
        return redirect()->route('autores.index')->with('success', 'Autor criado com sucesso.');
    }

    public function show(Autor $autor)
    {
        $autor->load('livros');
        return view('autores.show', compact('autor'));
    }

    public function edit(Autor $autor)
    {
        return view('autores.edit', compact('autor'));
    }

    public function update(AutorRequest $request, Autor $autor)
    {
        $autor->update($request->validated());
        return redirect()->route('autores.index')->with('success', 'Autor atualizado.');
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('autores.index')->with('success', 'Autor removido.');
    }
}
