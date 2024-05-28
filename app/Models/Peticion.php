<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Peticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_radicado',
        'asunto',
        'descripcion',
        'categoria',
        'fecha_vencimiento',
        'dias',
    ];

    protected $casts = [
        'fecha_vencimiento' => 'datetime',
    ];

    protected static $diasPorCategoria = [
        'especial' => 5,
        'informacion' => 10,
        'general' => 15,
        'consulta' => 30,
    ];

    protected $festivos = [
        '2024-01-01', '2024-01-08', '2024-03-25', '2024-03-28',
        '2024-03-29', '2024-05-01', '2024-05-13', '2024-06-03',
        '2024-06-10', '2024-07-01', '2024-07-20', '2024-08-07',
        '2024-08-19', '2024-10-14', '2024-11-04', '2024-11-11',
        '2024-12-08', '2024-12-25'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('completado', 'resumen');
    }

    public function calcularFechaVencimiento(Carbon $fechaInicio = null)
    {
        $fechaInicio = $fechaInicio ?? Carbon::now();
        $dias = self::$diasPorCategoria[$this->categoria];
        $fechaVencimiento = $fechaInicio->copy();

        for ($i = 0; $i < $dias; $i++) {
            $fechaVencimiento->addDay();
            while ($fechaVencimiento->isWeekend() || in_array($fechaVencimiento->toDateString(), $this->festivos)) {
                $fechaVencimiento->addDay();
            }
        }

        $this->fecha_vencimiento = $fechaVencimiento;
        $this->dias = $dias;
    }

    public function completarPeticionAdmin()
    {
        $this->estatus = !$this->estatus;
    }

    public function completarPeticionUser($userId, $resumen)
    {
        $usuarioPeticion = $this->users()->find($userId);
        $nuevoEstatus = !$usuarioPeticion->pivot->completado;

        $this->users()->updateExistingPivot($userId, [
            'completado' => $nuevoEstatus,
            'resumen' => $resumen
        ]);

        $todosCompletos = $this->users()->wherePivot('completado', false)->doesntExist();

        $this->estatus = $todosCompletos;
    }

    public function scopeNumeroRadicado(Builder $query, string $numeroRadicado): Builder
    {
        return $query->where('numero_radicado', 'LIKE', '%' . $numeroRadicado . '%');
    }
}
