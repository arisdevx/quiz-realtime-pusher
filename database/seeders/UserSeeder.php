<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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

        for ($i = 1; $i <= 2; $i++) {
            $user = new User;
            $user->name = $faker->name;
            $user->email = $faker->unique()->safeEmail;
            $user->email_verified_at = Carbon::now();
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
