<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class Usertable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'username' => '#viocake1',
                'email' => 'vioscake@gmail.com',
                'name' => 'Vios',
                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ],
        ];


        foreach ($userData as $key => $val){
            User::create($val);
        }
    }
}
