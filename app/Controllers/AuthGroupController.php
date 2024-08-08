<?php

namespace App\Controllers;

use App\Models\AuthGroup;
use App\Models\AuthGroupPermission;
use App\Models\AuthPermission;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

// class AuthGroupController extends ResourceController
class AuthGroupController extends BaseController

{
    protected $auth_group;
    protected $auth_permission;
    protected $auth_group_permission;


    public function __construct()
    {
        $this->auth_group = new AuthGroup();
        $this->auth_permission = new AuthPermission();
        $this->auth_group_permission = new AuthGroupPermission();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $data = $this->auth_group->getPaginate(5, $keyword);
        $currentPage = (int) $this->request->getVar('page') ?? 1;
        if ($currentPage > $data['totalPages']) {
            return redirect()->to(site_url('auth-groups'))->with('errors', 'Invlalid page');
        }
        return view('pages/AuthGroup/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $data['auth_permissions'] = $this->auth_permission->findAll();
        return view('pages/AuthGroup/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $this->auth_group->setValidationRules();
        $data = $this->request->getPost();

        if (isset($data['name'])) {
            $data['name'] = strtolower($data['name']);
        }

        $permissions = $data['permission_id'] ?? [];

        $this->auth_group->transStart();
        $save = $this->auth_group->insert($data);
        if ($save) {
            $groupId = $this->auth_group->insertID();
            foreach ($permissions as $permissionId) {
                $this->auth_group_permission->insert([
                    'group_id' => $groupId,
                    'permission_id' => $permissionId
                ]);
            }
            $this->auth_group->transComplete();

            if ($this->auth_group->transStatus() === false) {
                return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data.');
            }
            return redirect()->to(site_url('auth-groups'))->with('success', 'Data berhasil ditambahkan ke dalam daftar.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->auth_group->errors());
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $auth_group = $this->auth_group->find($id);
        if (is_object($auth_group)) {
            $data['auth_group'] = $auth_group;
            $data['auth_permissions'] = $this->auth_permission->findAll();
            $data['selected_permissions'] = array_column(
                $this->auth_group_permission->where('group_id', $id)->findAll(),
                'permission_id'
            );
            return view('pages/AuthGroup/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $this->auth_group->setValidationRules($id);
        $data = $this->request->getPost();
        if (isset($data['name'])) {
            $data['name'] = strtolower($data['name']);
        }

        $permissions = $data['permission_id'] ?? [];

        $this->auth_group->transStart();
        $save = $this->auth_group->update($id, $data);
        if ($save) {
            $this->auth_group_permission->where('group_id', $id)->delete();
            foreach ($permissions as $permissionId) {
                $this->auth_group_permission->insert([
                    'group_id' => $id,
                    'permission_id' => $permissionId
                ]);
            }
            $this->auth_group->transComplete();

            if ($this->auth_group->transStatus() === false) {
                return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data.');
            }
            return redirect()->to(site_url('auth-groups'))->with('success', 'Data berhasil diubah.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->auth_group->errors());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->auth_group->delete($id);
        return redirect()->to(site_url('auth-groups'))->with('success', 'Data berhasi dihapus.');
    }
}
