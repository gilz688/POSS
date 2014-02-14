<?php

class UserTableSeeder extends DatabaseSeeder{
    	public function run()
	{
            $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        ];
            
            foreach ($users as $user)
            {
                User::create($user);
            }   
	}
}
