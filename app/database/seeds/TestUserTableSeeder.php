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
                'role' => 'clerk',
                'firstname' => 'Kuroko',
                'middlename' => 'No',
                'lastname' => 'Basuke'
            ],
            [
                'username' => 'clerk2',
                'password' => Hash::make('clerk2_password'),
                'role' => 'clerk',
                'firstname' => 'San',
                'middlename' => 'Juan',
                'lastname' => 'Pedro'
            ],
            [
                'username' => 'auditor1',
                'password' => Hash::make('auditor1_password'),
                'role' => 'auditor'
            ]
        ];

        $faker = Faker\Factory::create();
        for($i=0;$i<20;$i++){
            array_push($users,[
                'username' => $faker->userName,
                'password' => Hash::make($faker->word),
                'role' => 'clerk',
                'firstname' => $faker->firstName,
                'middlename' => $faker->lastName,
                'lastname' => $faker->lastName
            ]);
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }

}


