<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animateur extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "prenom", "sexe", "age", "localisation_id", "photo"];

    public function localisation() {
        return $this->belongsTo(Localisation::class);
    }
}
