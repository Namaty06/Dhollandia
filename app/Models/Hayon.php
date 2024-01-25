<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hayon extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'serie',
        'pdf',
        'vehicule_id',
        'type_hayon_id',
        'capacite',
        'status_id'
    ];

    public function intervention()
    {
        return $this->hasMany(Hayon::class);

    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class)->withTrashed();
    }

    public function typehayon()
    {
        return $this->belongsTo(TypeHayon::class,'type_hayon_id')->withTrashed();
    }

    public function vehicules()
    {
        return $this->belongsToMany(Vehicule::class,'hayon_vehicule')->withTimestamps();
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->withTrashed();
    }



}
