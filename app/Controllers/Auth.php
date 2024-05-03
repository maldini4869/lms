<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!$this->request->is('post')) {
            $data = [
                'title' => 'LMS - Login',
            ];

            return view('auth/login', $data);
        }

        $rules = [
            'email'    => [
                'rules' => 'required|max_length[255]|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required|max_length[255]|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
        ];

        $data = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($data, $rules)) {
            return redirect()->to('/auth/login')->withInput();
        } else {
            return $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $this->userModel->where('email', $email)->first();

        if ($user) {
            $pass = $user['password'];
            $verifyPass = password_verify($password, $pass);
            if ($verifyPass) {
                $sessionData = [
                    'user_id'       => $user['id'],
                    'user_email'    => $user['email'],
                    'user_full_name'    => $user['full_name'],
                    'user_role_id'  => $user['role_id'],
                    'user_profile_picture' => $user['profile_picture'],
                    'logged_in'     => TRUE
                ];
                $this->session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {
                $this->session->setFlashdata('message', 'Email atau Password Salah!');
                return redirect()->to('/auth/login');
            }
        } else {
            $this->session->setFlashdata('message', 'Email atau Password Salah!');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}
