<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    public function setValidationRules($id = null, $data = null)
    {

        $rules = [
            'email' => 'required|valid_email' . ($id ? '|is_unique[users.email,id,' . $id . ']' : '|is_unique[users.email]'),
            'username' => 'required|alpha_numeric_punct|min_length[3]|max_length[30]' . ($id ? '|is_unique[users.username,id,' . $id . ']' : '|is_unique[users.username]'),
            'group_id' => 'required',
        ];

        if ($id === null) {
            $rules['password'] = 'required|max_length[255]|min_length[8]';
            $rules['confirm_password'] = 'required_with[password]|max_length[255]|matches[password]';
        } else {
            $rules['password'] = 'permit_empty|max_length[255]|min_length[8]';
            $rules['confirm_password'] = 'permit_empty|max_length[255]|matches[password]';
            if (isset($data['password']) && !empty($data['password'])) {
                $rules['confirm_password'] .= '|required_with[password]';
            }
        }

        $this->validationRules = $rules;
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
            $builder->like('username', $keyword);
            $builder->orLike('email', $keyword);
        }
        return [
            'users' => $this->paginate($perPage),
            'pager' => $this->pager,
            'currentPage' => $this->pager->getCurrentPage('default'),
            'totalPages'  => $this->pager->getPageCount('default'),
        ];
    }
}
