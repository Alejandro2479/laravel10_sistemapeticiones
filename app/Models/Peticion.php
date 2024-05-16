<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;


class Peticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_radicado',
        'asunto',
        'descripcion',
        'nota_devolucion',
        'nombre_devolucion',
        'email_devolucion',
        'fecha_vencimiento',
        'dias',
        'user_id'
    ];

    protected $casts = [
        'fecha_vencimiento' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alternarPeticion()
    {
        $this->estatus = !$this->estatus;
        $this->save();
    }

    public function scopeNumeroRadicado(Builder $query, string $numeroRadicado): Builder
    {
        return $query->where('numero_radicado', 'LIKE', '%' . $numeroRadicado . '%');
    }
}
