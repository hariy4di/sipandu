<?php

use Illuminate\Database\Seeder;

class firstclass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {

            if (DB::table('users')->count() == 0) {
                $password = \Hash::make('123456');
                $cms_users = DB::table('users')->insert([
                    'created_at' => date('Y-m-d H:i:s'),
                    'id' => 1,
                    'name' => 'Super Admin',
                    'email' => 'taufik.danar@gmail.com',
                    'password' => $password,
                    'id_cms_privileges' => 1,
                    'status' => 'Active',
                ]);
            }
        }
    }
}
