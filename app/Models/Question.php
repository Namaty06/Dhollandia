<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =[
        'status',
        'question',
        'examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function intervention()
    {
        return $this->belongsToMany(Intervention::class,'answers')->withPivot('observation','answer','path')->withTimestamps();
    }
    
}
