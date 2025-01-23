<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnderecoUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'cep',
        'uf',
        'cidade',
        'bairro',
        'logradouro',
        'numero',
        'usuario_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'usuario_id');
    }

}
