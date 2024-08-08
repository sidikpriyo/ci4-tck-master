<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;
use Myth\Auth\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'email' => 'gsidik52@gmail.com',
                'username' => 'sidik',
                'password_hash' => Password::hash('password'),
                'reset_hash' => NULL,
                'reset_at' => NULL,
                'reset_expires' => NULL,
                'activate_hash' => NULL,
                'status' => NULL,
                'status_message' => NULL,
                'active' => '1',
                'force_pass_reset' => '0',
                'created_at' => '2024-08-08 01:15:49',
                'updated_at' => '2024-08-08 01:15:49',
                'deleted_at' => NULL
            ],
        ];
        $UserModel = new User();
        $UserModel->insertBatch($data);
    }
}
