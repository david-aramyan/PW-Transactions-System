<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            0 => [
                'id'    => 1,
                'name'  => 'Admin',
            ],
            1 => [
                'id'    => 2,
                'name'  => 'User',
            ],
        ]);
    }
}
