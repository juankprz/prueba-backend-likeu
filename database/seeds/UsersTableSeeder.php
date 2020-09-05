<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Administrador 1',
                'email'=>'admin1@likeu.test',
                'password'=>Hash::make('likeu@123')
                ]
        );
        User::create(
            [
                'name' => 'Administrador 2',
                'email'=>'admin2@likeu.test',
                'password'=>Hash::make('likeu@123')
                ]
        );
    }
}
