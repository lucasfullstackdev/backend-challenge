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
            'msisdn'   => '+5588998052210',
            'name'     => 'Primeiro registro de teste',
            'password' => env('PASSWORD__HASH') ? bcrypt('123456'): '123456'
        ]);
        
        // $this->call(UsersTableSeeder::class);
    }
}
