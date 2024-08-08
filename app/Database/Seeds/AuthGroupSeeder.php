<?php

namespace App\Database\Seeds;

use App\Models\AuthGroup;
use CodeIgniter\Database\Seeder;

class AuthGroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'superadmin',
                'description' => 'superadmin bertanggungjawab mengatur dan mengelola sistem secara keseluruhan'
            ],
            [
                'name' => 'dekanat',
                'description' => 'dekanat memiliki peran .......'
            ],
            [
                'name' => 'pimpinan',
                'description' => 'pimpinan memiliki peran .......'
            ],
            [
                'name' => 'enumerator',
                'description' => 'enumerator memiliki peran .....'
            ],
        ];
        $authGroupModel = new AuthGroup();
        $authGroupModel->insertBatch($data);
    }
}
