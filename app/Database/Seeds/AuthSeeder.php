<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\AuthModel;

class AuthSeeder extends Seeder
{
    public function run()
    {
        $user = new AuthModel;
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 500; $i++) {
          $user->save(
                [
                    'name'        =>    $faker->name("female"),
                    'email'       =>    $faker->email,
                    'password'    =>    password_hash($faker->password, PASSWORD_DEFAULT),
                    'role'        =>    rand(1,5),
                ]
            );
        }
    }
}
