<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicule extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[

        'matricule',
        'typevehicule_id',
        'ville_id',
        'societe_id',
        'status_id'
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function typevehicule()
    {
        return $this->belongsTo(TypeVehicule::class);
    }

    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }

    public function reclamation()
    {
        return $this->hasMany(Reclamation::class);
    }

    public function hayon()
    {
        return $this->hasOne(Hayon::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function contrats()
    {
        return $this->belongsToMany(Contrat::class,'vehicule_contrat');
    }


    public function document()
    {
        return $this->morphMany(Document::class,'documentable');
    }

}
