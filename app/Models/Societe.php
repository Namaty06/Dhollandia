<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Societe extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'logo',
        'societe',
        'responsable',
        'adresse',
        'telephone',
        'fix',
        'email'
    ];

    public function contrat()
    {
        return $this->hasMany(Contrat::class);
    }

}
