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
        User::truncate();

        $user = new User;
        $user->name = "Anibal";
        $user->email = "jovomilla@gmail.com";
        $user->password = bcrypt('123456');
        $user->save();
    }
}
