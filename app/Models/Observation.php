<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'observation',
        'intervention_id'
    ];

    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
