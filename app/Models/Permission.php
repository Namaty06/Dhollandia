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
        self::firstOrCreate(['permission' => 'navigate_'.$table_name]);
        self::firstOrCreate(['permission' => 'update_'.$table_name]);
        self::firstOrCreate(['permission' => 'add_'.$table_name]);
        self::firstOrCreate(['permission' => 'delete_'.$table_name]);
        self::firstOrCreate(['permission' => 'restore_'.$table_name]);


    }
}
