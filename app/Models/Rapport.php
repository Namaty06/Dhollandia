<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rapport extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'intervention_id',
        'path',
        'ref'
    ];



    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }



}
