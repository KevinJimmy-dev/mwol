<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
use App\Models\Language;
use App\Models\Phrase;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Language::factory(1)->create();
        Word::factory(1)->create();
        Phrase::factory(3)->create();
    }
}
