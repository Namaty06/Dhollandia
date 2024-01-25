<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrat extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'societe_id',
        'ref',
        'date_debut',
        'date_fin',
        'status_id',
        'intervention_chaque',
        'day',
        'periode'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function interventions()
    {
        return $this->morphMany(Intervention::class, 'interventionable');
    }

    public function vehicules()
    {
        return $this->belongsToMany(Vehicule::class,'vehicule_contrat');
    }


}
