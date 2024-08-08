<?php

namespace App\Database\Seeds;

use App\Models\AuthGroupPermission;
use CodeIgniter\Database\Seeder;

class AuthGroupPermissionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id' => 1,
                'permission_id' => 1
            ],
            [
                'group_id' => 1,
                'permission_id' => 2
            ],
            [
                'group_id' => 1,
                'permission_id' => 3
            ],
            [
                'group_id' => 1,
                'permission_id' => 4
            ],
            [
                'group_id' => 1,
                'permission_id' => 5
            ]
        ];
        $authGroupPermission = new AuthGroupPermission();
        $authGroupPermission->insertBatch($data);
    }
}
