<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adm = \DB::table('users')
            ->where('id', 1)
            ->where('email', 'admin@mail.com')
            ->first();

        if ($adm === null) {
            \DB::table('users')->insert([
                'name' => 'Administrador',
                'email' => 'admin@mail.com',
                'password' => \Hash::make('147258369'),
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }


        \DB::table('people')->insert([
            [
                'name' => 'João Pedro'
            ],
            [
                'name' => 'Lucas Gabriel'
            ],
            [
                'name' => 'Luiz Felipe'
            ],
            [
                'name' => 'André Augusto'
            ],
            [
                'name' => 'Maria Luiza'
            ],
            [
                'name' => 'Joana Maria'
            ],
            [
                'name' => 'Alice Maia'
            ],
            [
                'name' => 'Laura Helena'
            ]
        ]);
    }
}
