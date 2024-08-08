<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('AuthPermissionSeeder');
        $this->call('AuthGroupSeeder');
        // $this->call('AuthGroupPermissionSeeder');
        $this->call('UserSeeder');
        $this->call('AuthGroupUserSeeder');
    }
}
