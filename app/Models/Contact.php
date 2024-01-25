<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'societe_id',
        'name',
        'email',
        'tel'
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

}
