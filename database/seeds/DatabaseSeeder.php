<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call($this->role());
        $this->call($this->admin());
    }

    private function role()
    {
        DB::table('contact')->insert([
            [
                'title' => 'Khách sạn SONA',
                'masothue' => '0108134425',
                'address' => 'Tòa nhà số 72 Trần Đăng Ninh, Cầu Giấy, Hà Nội',
                'phone' => '0388 34 64 13',
                'email' => 'thao19011999@gmail.com',
                'website' => 'Sona.com',
                'active' => '1'
            ]
        ]);
    }
    
    private function admin()
    {
            DB::table('admin')->insert([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone' => '0388346413',
                'level' => '1',
                'status' => '1',
                'created_at' => now(),
                'password' => bcrypt('123456'),
            ]);

    }
}
