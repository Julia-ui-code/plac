<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            // Nome será 'admin'
            'name' => 'Julia',
            // ==
            'email' => 'julia@gmail.com',
            // senha123 encriptada
            'password' => bcrypt('12345678')
        ]);
    }
}
