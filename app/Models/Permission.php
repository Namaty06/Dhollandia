<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable =['permission'];
    public $timestamps = false;

    public function role()
    {
        return $this->belongsToMany(Role::class , 'role_permission');
    }

    public static function generateFor($table_name )
    {
        self::firstOrCreate(['permission' => 'naviguer_'.$table_name]);
        self::firstOrCreate(['permission' => 'modifier_'.$table_name]);
        self::firstOrCreate(['permission' => 'ajouter_'.$table_name]);
        self::firstOrCreate(['permission' => 'supprimer_'.$table_name]);
        self::firstOrCreate(['permission' => 'restaurer_'.$table_name]);
    }
}
