<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'peticion_id',
        'user_id',
        'razon',
    ];

    public function peticion()
    {
        return $this->belongsTo(Peticion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
