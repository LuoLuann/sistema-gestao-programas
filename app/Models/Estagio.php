<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estagio extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'descricao',
        'data_inicio',
        'data_fim',
        'data_solicitacao',
        'tipo_estagio',
        'status'
    ];

    protected $dates = [
        'data_inicio',
        'data_fim',
        'data_solicitacao'
    ];
    

    public function aluno()
    {
        return $this->belongsTo(Aluno::class, "aluno_id");
        //return $this->belongsTo(Aluno::class, "cpf_aluno");
    }

    public function orientador()
    {
        return $this->belongsTo(Orientador::class, "orientador_id");
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, "curso_id");
    }

    /*public function servidor()
    {
        return $this->belongsTo(Servidor::class, "servidor_id");
    }*/

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, "supervisor_id");;
    }
    
}
