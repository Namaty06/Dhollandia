<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =['role'];

    public function user(){
        return $this->hasMany(User::class)->withTrashed();
    }

    public function permission(){

        return $this->belongsToMany(Permission::class , 'role_permission');
    }

    public function hasPermission($permission)
    {
        return $this->permission->contains('permission', $permission);
    }

}
