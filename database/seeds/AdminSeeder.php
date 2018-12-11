<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \Azizner\User::create(
            [
                'first_name' => 'Admin',
                'email' => 'admin@azizner.com',
                'is_moderator'=>true,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                ]
        );

        \Azizner\Admin::create(
            [
                'user_id' => $admin->id,
            ]
        );

        \Azizner\Creator::create(
            [
                'user_id' => $admin->id,
            ]
        );
    }
}
