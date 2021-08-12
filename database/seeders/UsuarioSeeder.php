<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'teste@email.com',
            'password' => Hash::make('senha'),
            'name' => 'Barbara',
            'cpf' => '00000000005',
            'status' => '1'
        ]);
    }
}
