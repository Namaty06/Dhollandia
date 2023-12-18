<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'numero_serie',
        'matricule',
        'typevehicule_id',
        'marque',
        'date_circulation',
        'capacite',
        'image',
        'status_id',
        'pdf'
    ];

    public function typevehicule()
    {
        return $this->belongsTo(TypeVehicule::class);
    }

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }

    public function reclamation()
    {
        return $this->hasMany(Reclamation::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function document()
    {
        return $this->morphMany(Document::class,'documentable');
    }

}
