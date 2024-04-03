<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;

    /*
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
    */

    protected $fillable = ['numero_radicado', 'asunto', 'descripcion'];

    public function alternarPeticion()
    {
        $this->estatus = !$this->estatus;
        $this->save();
    }
}