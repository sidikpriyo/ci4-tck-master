<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthPermission extends Model
{
    protected $table            = 'auth_permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'description'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    public function setValidationRules($id = null)
    {
        $this->validationRules = [
            'name' => 'required|min_length[3]|max_length[255]' . ($id ? '|is_unique[auth_permissions.name,id,' . $id . ']' : '|is_unique[auth_permissions.name]'),
            'description' => 'required|min_length[3]|max_length[255]',
        ];
    }
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function getPaginate($perPage, $keyword = null)
    {
        $builder = $this->builder();
        if ($keyword !== null) {
            $builder->like('name', $keyword);
        }
        return [
            'auth_groups' => $this->paginate($perPage),
            'pager' => $this->pager,
            'currentPage' => $this->pager->getCurrentPage('default'),
            'totalPages'  => $this->pager->getPageCount('default'),
        ];
    }
}
