<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Faker\Factory;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $user = new User([
            'username' => 'fikrisabriansyah',
            'name' => 'Fikri Sabriansyah',
            'password' => Hash::make('fikrisabriansyah'),
            'email' => 'fikrisabriansyah@gmail.com',
            'whatsapp_phone' => '085741982123',
        ]);

        $user->save();

        for ($i = 0; $i < 10; $i++) {
            $username = $faker->unique()->userName();

            $user = new User([
                'username' => $username,
                'name' => $faker->name(),
                'password' => Hash::make($username),
                'email' => $faker->unique()->email(),
                'whatsapp_phone' => $faker->unique()->phoneNumber(),
            ]);

            $user->save();
        }
    }
}
