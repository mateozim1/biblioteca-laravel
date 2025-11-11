<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Models\Livro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocacaoController extends Controller
{
    public function index()
    {
        $locacoes = Locacao::with(['usuario','livro'])->paginate(10);
        return view('locacoes.index', compact('locacoes'));
    }

    public function create()
    {
        $usuarios = User::all();
        $livros = Livro::where('quantidade_disponivel', '>', 0)->get();
        return view('locacoes.create', compact('usuarios','livros'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'livro_id' => 'required|exists:livros,id',
            'data_devolucao' => 'required|date|after:today',
        ]);

        return DB::transaction(function () use ($data) {
            $livro = Livro::lockForUpdate()->findOrFail($data['livro_id']);

            if ($livro->quantidade_disponivel <= 0) {
                return back()->withErrors(['livro' => 'Livro indisponível para locação.'])->withInput();
            }

            $already = Locacao::where('usuario_id', $data['usuario_id'])
                ->where('livro_id', $data['livro_id'])
                ->where('status', 'ativa')
                ->first();

            if ($already) {
                return back()->withErrors(['usuario' => 'Usuário já possui este livro locado.'])->withInput();
            }

            $locacao = Locacao::create([
                'usuario_id' => $data['usuario_id'],
                'livro_id' => $data['livro_id'],
                'data_locacao' => now()->toDateString(),
                'data_devolucao' => $data['data_devolucao'],
                'status' => 'ativa'
            ]);

            $livro->decrement('quantidade_disponivel');

            return redirect()->route('locacoes.index')->with('success', 'Locação criada.');
        });
    }

    public function show($id)
    {
        $locacao = Locacao::with(['usuario','livro'])->findOrFail($id);
        return view('locacoes.show', compact('locacao'));
    }

    public function destroy($id)
    {
        Locacao::findOrFail($id)->delete();
        return redirect()->route('locacoes.index')->with('success', 'Locação removida.');
    }

    public function devolver($id)
    {
        $locacao = Locacao::findOrFail($id);

        if ($locacao->status !== 'ativa') {
            return redirect()->route('locacoes.index')->with('error', 'Locação não está ativa.');
        }

        return DB::transaction(function () use ($locacao) {
            $livro = Livro::lockForUpdate()->findOrFail($locacao->livro_id);
            $livro->increment('quantidade_disponivel');

            $locacao->update([
                'status' => 'devolvida',
                'data_devolvido' => now()->toDateString()
            ]);

            return redirect()->route('locacoes.index')->with('success', 'Livro devolvido com sucesso.');
        });
    }
}
