<?php

namespace App\Controllers;

use App\Models\AuthGroup;
use App\Models\AuthGroupUser;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Password;

class UserController extends BaseController
{
    protected $users;
    protected $auth_groups;
    protected $auth_group_user;
    protected $modelName;

    public function __construct()
    {
        $this->users = new User();
        $this->auth_groups = new AuthGroup();
        $this->auth_group_user = new AuthGroupUser();
        $this->modelName = 'user';
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $permission = 'view_any_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        $keyword = $this->request->getVar('keyword');
        $data = $this->users->getPaginate(5, $keyword);
        $currentPage = (int) $this->request->getVar('page') ?? 1;
        if ($currentPage > $data['totalPages']) {
            return redirect()->to(site_url('users'))->with('errors', 'Invlalid page');
        }
        return view('pages/User/index', $data);
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
        $permission = 'view_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        return "show user : $id";
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {

        $permission = 'create_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        $data['auth_groups'] = $this->auth_groups->findAll();
        return view('pages/User/create', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $permission = 'create_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        if (!$this->defineSuperAdmin()) {
            if (!has_permission('can_create_user')) {
                return view('errors/custom/403');
            }
        }
        $this->users->setValidationRules();
        $data = $this->request->getPost();
        if (isset($data['username'])) {
            $data['username'] = strtolower($data['username']);
            $data['password_hash'] = Password::hash($data['password']);
        }

        $this->users->transStart();
        $save = $this->users->insert($data);
        if ($save) {
            $userId = $this->users->insertID();
            $this->auth_group_user->insert([
                'group_id' => $data['group_id'],
                'user_id' => $userId,
            ]);

            $this->users->transComplete();

            if ($this->users->transStatus() === false) {
                return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data.');
            }
            return redirect()->to(site_url('users'))->with('success', 'Data berhasil ditambahkan ke dalam daftar.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->users->errors());
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
        $permission = 'edit_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        $user = $this->users->find($id);
        if (is_object($user)) {
            $data['users'] = $user;
            $selected_groups = $this->auth_group_user->where('user_id', $user->id)->findAll();
            $group_id = array_column($selected_groups, 'group_id');
            $data['selected_group'] = !empty($group_id) ? $group_id[0] : null;
            $data['auth_groups'] = $this->auth_groups->findAll();
            return view('pages/User/edit', $data);
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
        $permission = 'edit_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        $data = $this->request->getPost();
        $this->users->setValidationRules($id, $data);
        if (isset($data['username'])) {
            if (!empty($data['password'])) {
                $data['password_hash'] = Password::hash($data['password']);
            } else {
                unset($data['password']);
            }
            $data['username'] = strtolower($data['username']);
        }
        $this->users->transStart();
        $save = $this->users->update($id, $data);
        if ($save) {
            $this->auth_group_user->where('user_id', $id)->delete();
            $this->auth_group_user->insert([
                'user_id' => $id,
                'group_id' => $data['group_id']
            ]);

            $this->users->transComplete();

            if ($this->users->transStatus() === false) {
                return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data.');
            }
            return redirect()->to(site_url('users'))->with('success', 'Data berhasil diubah.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->users->errors());
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
        $permission = 'delete_' . $this->modelName;
        if (!$this->defineSuperAdmin()) {
            if (!has_permission($permission)) {
                return view('errors/custom/403');
            }
        }
        $this->users->delete($id);
        return redirect()->to(site_url('users'))->with('success', 'Data berhasi dihapus.');
    }
}
