<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'path',
        'type_document_id'
    ];


    public function typedocument()
    {
        return $this->belongsTo(TypeDocument::class,'type_document_id');
    }

    // public function intevention()
    // {
    //     return $this->belongsTo(Intervention::class);
    // }

    public function documentable()
    {
        return $this->morphTo();
    }
}
