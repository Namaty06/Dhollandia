<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeIntervention extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'type'
    ];

    public function intervention()
    {
        return $this->hasMany(Intervention::class);
    }
}
