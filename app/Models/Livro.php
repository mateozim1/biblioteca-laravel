<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $fillable = [
        'titulo',
        'autor_id',
        'categoria_id',
        'ano_publicacao',
        'quantidade_total',
        'quantidade_disponivel',
        'isbn',
        'status'
    ];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function locacoes()
    {
        return $this->hasMany(Locacao::class, 'livro_id');
    }
}
