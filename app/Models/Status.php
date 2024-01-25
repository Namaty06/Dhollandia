<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'color'
    ];

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }

    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }

    public function reclamation()
    {
        return $this->hasMany(Reclamation::class);
    }

    public function vehicule()
    {
        return $this->hasMany(Vehicule::class);
    }

    public function hayon()
    {
        return $this->hasMany(Hayon::class);
    }

}
