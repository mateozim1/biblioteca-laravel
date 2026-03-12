<?php

namespace App\Http\Controllers;

use App\Http\Requests\Locacao\StoreLocacaoRequest;
use App\Models\Livro;
use App\Models\Locacao;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LocacaoController extends Controller
{
    public function index()
    {
        $locacoes = Locacao::with(['usuario', 'livro'])->paginate(10);
        return view('locacoes.index', compact('locacoes'));
    }

    public function create()
    {
        $usuarios = User::all();
        $livros = Livro::where('quantidade_disponivel', '>', 0)->get();
        return view('locacoes.create', compact('usuarios', 'livros'));
    }

    public function store(StoreLocacaoRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function () use ($data) {
            $livro = Livro::lockForUpdate()->findOrFail($data['livro_id']);

            if ($livro->quantidade_disponivel <= 0) {
                return back()->withErrors(['livro' => 'Livro indisponivel para locacao.'])->withInput();
            }

            $already = Locacao::where('usuario_id', $data['usuario_id'])
                ->where('livro_id', $data['livro_id'])
                ->where('status', 'ativa')
                ->first();

            if ($already) {
                return back()->withErrors(['usuario' => 'Usuario ja possui este livro locado.'])->withInput();
            }

            Locacao::create([
                'usuario_id' => $data['usuario_id'],
                'livro_id' => $data['livro_id'],
                'data_locacao' => now()->toDateString(),
                'data_devolucao' => $data['data_devolucao'],
                'status' => 'ativa',
            ]);

            $livro->decrement('quantidade_disponivel');

            return redirect()->route('locacoes.index')->with('success', 'Locacao criada.');
        });
    }

    public function show(Locacao $locacao)
    {
        $locacao->load(['usuario', 'livro']);
        return view('locacoes.show', compact('locacao'));
    }

    public function destroy(Locacao $locacao)
    {
        $locacao->delete();
        return redirect()->route('locacoes.index')->with('success', 'Locacao removida.');
    }

    public function devolver(Locacao $locacao)
    {
        if ($locacao->status !== 'ativa') {
            return redirect()->route('locacoes.index')->with('error', 'Locacao nao esta ativa.');
        }

        return DB::transaction(function () use ($locacao) {
            $livro = Livro::lockForUpdate()->findOrFail($locacao->livro_id);
            $livro->increment('quantidade_disponivel');

            $locacao->update([
                'status' => 'devolvida',
                'data_devolvido' => now()->toDateString(),
            ]);

            return redirect()->route('locacoes.index')->with('success', 'Livro devolvido com sucesso.');
        });
    }
}
