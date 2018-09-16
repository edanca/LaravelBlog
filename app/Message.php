<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Message extends Model
{
	use Searchable;
	
    // Para evitar el error MassAssignmentException se agrega $guarded como vacio
    // Array de columnas que sten protegidas, tales como contraseñas o algo privado
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
	}
	

	public function getImageAttribute($image) {
		// When adding get at the begining and Attribute at the end we intercep the "Image" attribute when this is requested by its Model
		if (!$image || starts_with($image, 'http')) {
			return $image;
		}

		return \Storage::disk('public')->url($image);
	}


	public function toSearchableArray() {
		// Al message le cargamos el usuario que lo genera
		$this->load('user');

		return $this->toArray();
	}


	public function responses() {

		return $this->hasMany(Response::class)->latest();
	}
}
