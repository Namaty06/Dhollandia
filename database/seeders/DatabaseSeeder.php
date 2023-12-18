<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Role::create([
        //     'role' => 'Admin'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'role_id'=> 1
        // ]);
        // $this->call(StatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $role = Role::whereId(1)->first();
        $permissions = Permission::all();
        foreach($permissions as $p){
            $role->permission()->attach($p->id);
        }
    }
}
