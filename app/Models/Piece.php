<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'piece',
        'qte',
        'intervention_id'
    ];


    public function intervention()
    {
        return $this->belongsTo(Intervention::class);
    }

}
