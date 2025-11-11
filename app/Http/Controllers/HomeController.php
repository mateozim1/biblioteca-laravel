<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class HomeController extends Controller
{
    public function index()
    {
        $livros = Livro::with('autor','categoria')->latest()->take(6)->get();
        return view('home', compact('livros'));
    }
}
