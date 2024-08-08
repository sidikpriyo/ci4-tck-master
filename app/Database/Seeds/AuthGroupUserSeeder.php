<?php

namespace App\Database\Seeds;

use App\Models\AuthGroupUser;
use CodeIgniter\Database\Seeder;

class AuthGroupUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id' => 1,
                'user_id' => 1
            ],
        ];
        $authGroupUser = new AuthGroupUser();
        $authGroupUser->insertBatch($data);
    }
}
