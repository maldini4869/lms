<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\UserModel;

class Student extends BaseController
{

    protected $userModel;
    protected $studentModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $students = $this->studentModel->select('student.id as id, student.user_id as user_id, user.email as email, user.full_name as full_name, student.nisn as nisn, user.is_active as is_active')->join('user', 'user.id = student.user_id')->orderBy('student.id', 'asc')->findAll();

        $data = [
            'title' => 'LMS - Siswa',
            'students' => $students
        ];
        return view('student/list', $data);
    }

    public function add()
    {
        if (!$this->request->is('post')) {
            $data = [
                'title' => 'LMS - Tambah Siswa',
            ];

            return view('student/add', $data);
        }

        $rules = [
            'full_name'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'email'    => [
                'rules' => 'required|max_length[255]|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar',
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
            'nisn'    => [
                'rules' => 'required|max_length[255]|is_unique[student.nisn]',
                'errors' => [
                    'required' => 'NIP harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'profile_picture'    => [
                'rules' => 'max_size[profile_picture,5120]|is_image[profile_picture]|mime_in[profile_picture, image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => 'Ukuran file harus dibawah 5MB',
                    'is_image' => 'Tipe file harus gambar',
                    'mime_in'  => 'Tipe file hanya boleh image/png, image/jpeg, image/jpg'
                ]
            ],
            'phone_number'    => [
                'rules' => 'required|max_length[18]',
                'errors' => [
                    'required' => 'Nomor HP harus diisi',
                    'max_length' => 'Jumlah karakter melebihi 18 karakter',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/siswa/tambah')->withInput();
        }

        $profilePicture = $this->request->getFile('profile_picture');

        if ($profilePicture->getError() == 4) {
            $profilePictureName = 'undraw_profile.svg';
        } else {
            $profilePictureName = $profilePicture->getRandomName();
            $profilePicture->move('img/profile', $profilePictureName);
        }

        $userData = [
            'full_name' => $input['full_name'],
            'email' => $input['email'],
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'role_id' => ROLE_STUDENT,
            'profile_picture' => $profilePictureName,
            'phone_number' => $input['phone_number'],
            'is_active' => USER_ACTIVE
        ];

        $userId = $this->userModel->insert($userData);

        $studentData = [
            'user_id' => $userId,
            'nisn' => $input['nisn'],
        ];

        $result = $this->studentModel->insert($studentData, false);
        if ($result) {
            session()->setFlashdata('success', 'Siswa Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Siswa Gagal Dibuat!');
        }

        return redirect()->to('/siswa');
    }

    public function edit($id)
    {
        if (!$this->request->is('post')) {
            $student = $this->studentModel->select('student.id as id, student.user_id as user_id, user.email as email, user.full_name as full_name, student.nisn as nisn, user.profile_picture as profile_picture, user.phone_number as phone_number, user.is_active as is_active')->join('user', 'user.id = student.user_id')->where('student.id', $id)->orderBy('student.id', 'asc')->first();

            $data = [
                'title' => 'LMS - Ubah Siswa',
                'student' => $student,
            ];

            return view('student/edit', $data);
        }

        $rules = [
            'full_name'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'nisn'    => [
                'rules' => 'required|max_length[255]|is_unique[student.nisn]',
                'errors' => [
                    'required' => 'NIP harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'profile_picture'    => [
                'rules' => 'max_size[profile_picture,5120]|is_image[profile_picture]|mime_in[profile_picture, image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => 'Ukuran file harus dibawah 5MB',
                    'is_image' => 'Tipe file harus gambar',
                    'mime_in'  => 'Tipe file hanya boleh image/png, image/jpeg, image/jpg'
                ]
            ],
            'phone_number'    => [
                'rules' => 'required|max_length[18]',
                'errors' => [
                    'required' => 'Nomor HP harus diisi',
                    'max_length' => 'Jumlah karakter melebihi 18 karakter',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        $input['old_profile_picture'] = $this->request->getVar('old_profile_picture');
        $input['user_id'] = $this->request->getVar('user_id');

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/siswa/ubah/' . $id)->withInput();
        }

        $profilePicture = $this->request->getFile('profile_picture');

        // Check if still old picture
        if ($profilePicture->getError() == 4) {
            $profilePictureName = $input['old_profile_picture'];
        } else {
            $profilePictureName = $profilePicture->getRandomName();
            $profilePicture->move('img/profile', $profilePictureName);
            if ($input['old_profile_picture'] != 'undraw_profile.svg') {
                unlink('img/profile/' . $input['old_profile_picture']);
            }
        }

        $userData = [
            'id' => $input['user_id'],
            'full_name' => $input['full_name'],
            'profile_picture' => $profilePictureName,
            'phone_number' => $input['phone_number']
        ];

        $this->userModel->save($userData);

        $studentData = [
            'id' => $id,
            'nisn' => $input['nisn'],
        ];

        $result = $this->studentModel->save($studentData, false);

        if ($result) {
            session()->setFlashdata('success', 'Siswa Berhasil Diubah!');
        } else {
            session()->setFlashdata('failed', 'Siswa Gagal Diubah!');
        }

        return redirect()->to('/siswa');
    }

    public function delete($id)
    {
        $student = $this->studentModel->find($id);
        $user = $this->userModel->find($student['user_id']);

        // Check if our current image is our default profile image
        if ($user['profile_picture'] != 'undraw_profile.svg') {
            // Delete image in explorer
            unlink('img/profile/' . $user['profile_picture']);
        }

        $this->studentModel->delete($id);
        $this->userModel->delete($user['id']);

        session()->setFlashdata('success', 'Siswa Berhasil Dihapus!');

        return redirect()->to('/siswa');
    }
}
