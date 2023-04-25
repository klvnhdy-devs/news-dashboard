<?php

namespace Database\Seeders;

use App\Models\newsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class newsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       newsModel::factory(10)->create();
    }
}
