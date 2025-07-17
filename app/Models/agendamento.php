<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos via mass assignment
    protected $fillable = [
        'nome',
        'email',
        'servico_id',
        'data',
        'horario',
    ];

    // Define a relação com o modelo Service (um agendamento pertence a um serviço)
    public function service()
    {
        return $this->belongsTo(Service::class, 'servico_id');
    }
}
