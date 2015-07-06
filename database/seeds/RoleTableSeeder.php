<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('roles')->insert([
			[
				'name' => 'admin',
				'display_name' => 'Administrator',
				'description' => 'Administrator role'
			],
			[
				'name' => 'staff',
				'display_name' => 'Staff',
				'description' => 'Staff role'
			]
		]);

		// DB::table('roles')->insert();
    }
}
