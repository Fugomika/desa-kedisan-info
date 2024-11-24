<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // If user is already logged in, redirect to dashboard
        if(session()->get('isLoggedIn')) {
            return redirect()->to('/penduduk');
        }
        // Display login page
        return view('auth/login');
    }

    public function process()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Find user by username
        $user = $userModel->where('username', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            session()->set('isLoggedIn', true);
            session()->set('role', $user['role']);
            session()->set('username', $user['username']);
            session()->set('name', $user['name']);
            session()->set('id', $user['id']);

            return redirect()->to('/');
        }

        // Username or password is wrong
        return redirect()->to('login')->with('error', 'Username atau password salah.');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
