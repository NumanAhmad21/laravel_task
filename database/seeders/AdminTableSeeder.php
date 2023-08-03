<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $password = Hash::make('travel2023');
        $adminRecords = [
            ['id'=>1, 'name'=>'Admin', 'type'=> 'admin', 'mobile'=> '971557030435', 'email'=> 'admin@gmail.com',
            'password'=>$password, 'image'=>'', 'age'=> '28 Years', 'status'=> 1,
            ],
        ];
        Admin::insert($adminRecords);
    }
}
