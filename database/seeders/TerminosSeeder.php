<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Termsandconditions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TerminosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 
        $tyc = new Termsandconditions;
        $tyc->tac = "Terms and conditions of use: ok";
        $tyc->save();

        $tyc1 = new Termsandconditions;
        $tyc1->tac = "Terms and conditions of use: ok";
        $tyc1->save();
    }
}
