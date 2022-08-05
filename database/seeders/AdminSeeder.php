<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::firstOrCreate([
            'id'=>Str::uuid(),
            'first_name' => 'Admin',
            'last_name' => '',
            'email' => 'admin@admin.com',
            'mobile_no' => '9999999999',
            'email_verified_at' => date('Y-m-d h:i:s'),
            'password' => bcrypt('password'),
            'role' => 'super-admin'
        ]);
    }
}
