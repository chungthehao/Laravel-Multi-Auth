<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@1.io',
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);
    }
}
