<?php

namespace App\Controllers;

use App\Models\PengumumanModel;
use App\Models\PendudukModel;
use App\Models\UserModel; 
use CodeIgniter\Controller;

class Users extends Controller
{
    protected $userModel, $pengumumanModel, $pendudukModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pengumumanModel = new PengumumanModel();
        $this->pendudukModel = new PendudukModel();
    }

    // Display the list of users
    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    // Show the form to create a new user
    public function create()
    {
        return view('users/form');
    }

    // Store a new user
    public function store()
    {
        // Validate the input
        $validation = $this->validate([
            'name' => 'required',
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,user]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Hash the password before saving
        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to('/users')->with('message', 'User berhasil ditambahkan.');
    }

    // Show the form to edit an existing user
    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User  not found');
        }

        $data['user'] = $user;
        return view('users/form', $data);
    }

    // Update an existing user
    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User  not found');
        }

        // Validate the input
        $validation = $this->validate([
            'name' => 'required',
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username,id,' . $id . ']',
            'password' => 'permit_empty|min_length[6]',
            'role' => 'required|in_list[admin,user]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare data for updating
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'role' => $this->request->getPost('role'),
        ];

        // Only update the password if it was provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        return redirect()->to('/users')->with('message', 'User berhasil diperbarui.');
    }

    // Delete a user
    public function delete($id)
    {
        if ($id == 1) {
            return redirect()->to('/users')->with('message', 'User utama tidak boleh dihapus.');
        }
        // set pengumuman and penduduk to 1 if user is deleted
        $this->pengumumanModel->where('created_by', $id)->set(['created_by' => 1])->update();
        $this->pendudukModel->where('created_by', $id)->set(['created_by' => 1])->update();
        $this->userModel->delete($id);
        return redirect()->to('/users')->with('message', 'User berhasil dihapus.');
    }
}