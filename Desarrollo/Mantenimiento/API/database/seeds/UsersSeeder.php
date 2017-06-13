<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use API\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $users = [
        	['name' => 'Yair', 'email' => 'yairheli@gmail.com', 'password' => Hash::make('hola')]
        ];

        foreach ($users as &$user) {
        	User::create($user);
        }

        Model::reguard();
    }
}
