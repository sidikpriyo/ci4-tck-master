<?php

namespace App\Controllers;

use App\Models\AuthPermission;
use CodeIgniter\HTTP\ResponseInterface;

class AuthPermissionController extends BaseController
{

    protected $auth_permission;

    public function __construct()
    {
        $this->auth_permission = new AuthPermission();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $data = $this->auth_permission->getPaginate(5, $keyword);
        $currentPage = (int) $this->request->getVar('page') ?? 1;
        if ($currentPage > $data['totalPages']) {
            return redirect()->to(site_url('auth-groups'))->with('errors', 'Invlalid page');
        }
        return view('pages/AuthPermission/index', $data);
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
        // $keyword = $this->request->getVar('keyword');
        // $data = $this->auth_permission->getPaginate(5, $keyword);
        return view('pages/AuthPermission/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $this->auth_permission->setValidationRules();
        $data = $this->request->getPost();
        if (isset($data['name'])) {
            $data['name'] = strtolower($data['name']);
        }

        $save =  $this->auth_permission->insert($data);
        if (!$save) {
            return redirect()->back()->withInput()->with('errors', $this->auth_permission->errors());
        } else {
            return redirect()->to(site_url('auth-permissions'))->with('success', 'Data berhasi ditambahkan kedalam daftar.');
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
        $auth_permission = $this->auth_permission->find($id);
        if (is_object($auth_permission)) {
            $data['auth_permission'] = $auth_permission;
            return view('pages/AuthPermission/edit', $data);
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
        $this->auth_permission->setValidationRules($id);
        $data = $this->request->getPost();
        if (isset($data['name'])) {
            $data['name'] = strtolower($data['name']);
        }

        $save = $this->auth_permission->update($id, $data);
        if (!$save) {
            return redirect()->back()->withInput()->with('errors', $this->auth_permission->errors());
        } else {
            return redirect()->to(site_url('auth-permissions'))->with('success', 'Data berhasi diubah.');
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
        $this->auth_permission->delete($id);
        return redirect()->to(site_url('auth-permissions'))->with('success', 'Data berhasi dihapus.');
    }
}
