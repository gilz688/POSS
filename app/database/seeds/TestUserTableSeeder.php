<?php

class TestUserTableSeeder extends DatabaseSeeder {

    public function run() {
        $users = [
            [
                'username' => 'admin1',
                'password' => Hash::make('admin1_password'),
                'role' => 'admin'
            ],
            [
                'username' => 'clerk1',
                'password' => Hash::make('clerk1_password'),
                'role' => 'clerk'
            ],
            [
                'username' => 'auditor1',
                'password' => Hash::make('auditor1_password'),
                'role' => 'auditor'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }

}


