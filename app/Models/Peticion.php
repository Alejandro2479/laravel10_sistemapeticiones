<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_radicado', 
        'asunto', 
        'descripcion',
        'user_id'
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
}
