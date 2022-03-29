<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','n.himel143@gmail.com')->first();
        if(is_null($user)){
            $user = new User();
            $user->email = 'n.himel143@gmail.com';
            $user->name = 'Nuruzzaman Himel';
            $user->password = Hash::make('123456789');
            $user->save();
        }
    }
}
