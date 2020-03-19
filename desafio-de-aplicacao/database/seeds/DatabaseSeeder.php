<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'msisdn'   => '+5588998052285',
            'name'     => 'Primeiro registro de teste',
            'password' => '123456'
        ]);
    }
}
