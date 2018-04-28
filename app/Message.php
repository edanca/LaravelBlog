<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Para evitar el error MassAssignmentException
    // Array de columnas que sten protegidas, tales como contraseñas o algo privado
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
