<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
        $this->call(userSeeder::class);
    }
}
class userSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            ['name'=>'ngoc','email'=>'ngoc@gmail.com','password'=>bcrypt(456456)],
            ['name'=>'nhat','email'=>'nhat@gmail.com','password'=>bcrypt(123123)]

        ]);
    }
}

