<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        		'name' => 'jose',
        		'email' => 'jose@trocobuy.com',
        		'password' => Hash::make('123456'),
                'created_at' => date('Y-m-d H:i:s'),
        	],
            [
                'name' => 'paco',
                'email' => 'paco@trocobuy.com',
                'password' => Hash::make('123456'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        foreach ($users as $user) {

        	\App\User::create($user);
        	# code...
        }
    }
}
