<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reclamation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'ref',
        'societe_id',
        'status_id',
        'vehicule_id',
        'user_id',
        'transport_id'
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function transport()
    {
        return $this->belongsTo(Vehicule::class,'transport_id');
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function interventions()
    {
        return $this->morphOne(Intervention::class, 'interventionable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
