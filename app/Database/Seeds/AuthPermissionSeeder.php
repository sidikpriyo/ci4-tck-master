<?php

namespace App\Database\Seeds;

use App\Models\AuthPermission;
use CodeIgniter\Database\Seeder;

class AuthPermissionSeeder extends Seeder
{
    public function run()
    {
        $model = [
            'group' => 'auth_group',
            'permission' => 'auth_permission',
            'user' => 'user',
        ];

        $model_aliases = [
            'group' => 'peran',
            'permission' => 'hak akses',
            'user' => 'akun',
        ];

        $prefix = [
            [
                'name' => 'view_',
                'aliases' => 'melihat'
            ],
            [
                'name' => 'view_any_',
                'aliases' => 'melihat semua'
            ],
            [
                'name' => 'create_',
                'aliases' => 'menambahkan'
            ],
            [
                'name' => 'edit_',
                'aliases' => 'mengubah'
            ],
            [
                'name' => 'delete_',
                'aliases' => 'menghapus'
            ],
        ];

        foreach ($model as $k => $value) {
            foreach ($prefix as $key => $result) {
                $data[] = [
                    'name' => $result['name'] . $value,
                    'description' => "pengguna dapat $result[aliases] $model_aliases[$k]"
                ];
            }
        }


        $authPermissionModel = new AuthPermission();
        $authPermissionModel->insertBatch($data);
    }
}
