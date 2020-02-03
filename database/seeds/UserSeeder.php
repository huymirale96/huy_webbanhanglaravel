<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','trung@gmail.com')->first();
        if(!$user) {
        	$user = new User();
        	$user->name = 'Trung';
        	$user->email = 'trung@gmail.com';
        	$user->password = encrypt('12345678');
        	$user->save();

        }
        $admin = User::where('email','admin@gmail.com')->first();
        if(!$admin) {
        	$admin= new User();
        	$admin->name = 'Admin';
        	$admin->email = 'admin@gmail.com';
        	$admin->password = encrypt('123456');
        	$admin->save();

        }
    }
}
