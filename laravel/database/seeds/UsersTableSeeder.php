<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class) -> create([
            'email' => 'test@test.com',
            'password' => 'qwerty'
        ]);
        factory(User::class, 10) -> create();
    }
}
