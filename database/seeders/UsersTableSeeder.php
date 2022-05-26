<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Administrator',
                'email' => 'administrador@example.net',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => 'cFKoGftd274fB7VvkufMXkwFjR2hi04j1Ve0K0QItLKv4CtCXETXUnHcAWzB',
                'role'=> 'ADMINISTRATOR'
            ]
        );

//        comando que, utilizando a factory, criará 40 usuários, quando executar a SEED no terminal
        factory(\App\User::class, 40)->create()->each(function($user){
            $user->store()->save(factory(\App\Store::class)->make());
        });
    }
}

