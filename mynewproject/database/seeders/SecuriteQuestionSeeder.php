<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecuriteQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('securite_question')->insert([
            ['question' => "What is your mother's maiden name?"],
            ['question' => 'What was the name of your first pet?'],
            ['question' => 'What was the make and model of your first car?'],
            ['question' => 'In what city were you born?'],
            ['question' => 'What is your favorite book?'],
        ]);
    }
}
