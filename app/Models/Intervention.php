<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervention extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'contrat_id',
        'status_id',
        'user_id',
        'rapport_id',
        'date_intervention',
        'lat',
        'lng',
        'date_validation',
        'type_panne_id',
        'bon_travail',
        'hayon_id'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function hayon()
    {
        return $this->belongsTo(Intervention::class);
    }

    public function typepanne()
    {
        return $this->belongsTo(TypePanne::class,'type_panne_id')->withTrashed();
    }

    public function question()
    {
        return $this->belongsToMany(Question::class,'answers')->withPivot('observation','answer','path')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function contrat()
    // {
    //     return $this->belongsTo(Contrat::class);
    // }

    public function rapport()
    {
        return $this->hasOne(Rapport::class);
    }

    public function document()
    {
        return $this->morphMany(Document::class,'documentable');
    }

    public function piece()
    {
        return $this->hasMany(Piece::class);
    }

    public function interventionable()
    {
        return $this->morphTo();
    }

    public function observation()
    {
        return $this->hasMany(Observation::class);
    }

}
