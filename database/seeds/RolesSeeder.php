<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Адміністратор',
            'description' => 'Almighty admin. Can do everything'
        ]);
        DB::table('role_user')->insert(['user_id' => 1, 'role_id' => 1]);
    }
}
