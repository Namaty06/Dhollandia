<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::generateFor('utilisateurs');
        Permission::generateFor('vehicules');
        Permission::generateFor('hayons');
        // Permission::generateFor('roles');
        Permission::create([
            'permission'=>'gestion_role_permission'
        ]);
        Permission::generateFor('societes');
        Permission::generateFor('contrats');
        Permission::generateFor('interventions');
        Permission::generateFor('examens');
        Permission::generateFor('questions');
        Permission::generateFor('reclamations');
        Permission::generateFor('configurations');
        Permission::generateFor('villes');

    }
}
