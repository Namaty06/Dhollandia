<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s1 = Status::create(['status'=>'Encours','color'=>'primary']);
        $s2 = Status::create(['status'=>'Terminer','color'=>'success']);
        $s3 = Status::create(['status'=>'Annulé','color'=>'danger']);

    }
}
