<?php

namespace App\Controllers;

use App\Models\SubjectModel;
use App\Models\TeacherModel;
use App\Models\TeacherSubjectModel;
use App\Models\UserModel;

class Teacher extends BaseController
{

    protected $userModel;
    protected $teacherModel;
    protected $subjectModel;
    protected $teacherSubjectModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->teacherModel = new TeacherModel();
        $this->subjectModel = new SubjectModel();
        $this->teacherSubjectModel = new TeacherSubjectModel();
    }

    public function index()
    {
        $teachers = $this->teacherModel->select('teachers.id as id, teachers.user_id as user_id, users.email as email, users.full_name as full_name, teachers.nip as nip, users.is_active as is_active')->join('users', 'users.id = teachers.user_id')->orderBy('users.full_name', 'asc')->findAll();

        $data = [
            'title' => 'LMS - Guru',
            'teachers' => $teachers
        ];
        return view('teacher/list', $data);
    }

    public function add()
    {
        if (!$this->request->is('post')) {
            $subjects = $this->subjectModel->findAll();

            $data = [
                'title' => 'LMS - Tambah Guru',
                'subjects' => $subjects,
            ];

            return view('teacher/add', $data);
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
                'rules' => 'required|max_length[255]|valid_email|is_unique[users.email]',
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
            'nip'    => [
                'rules' => 'required|max_length[255]|is_unique[teachers.nip]',
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
            'subject_id[]'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mata Pelajaran harus diisi',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/guru/tambah')->withInput();
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
            'role_id' => ROLE_TEACHER,
            'profile_picture' => $profilePictureName,
            'phone_number' => $input['phone_number'],
            'is_active' => USER_ACTIVE
        ];

        $userId = $this->userModel->insert($userData);

        $teacherData = [
            'user_id' => $userId,
            'nip' => $input['nip'],
        ];

        $teacherId = $this->teacherModel->insert($teacherData, true);

        $subjectIds = $this->request->getVar('subject_id[]');
        $teacherSubjectData = [];
        foreach ($subjectIds as $subjectId) {
            array_push($teacherSubjectData, ['teacher_id' => $teacherId, 'subject_id' => $subjectId]);
        }

        $result = $this->teacherSubjectModel->insertBatch($teacherSubjectData);

        if ($result) {
            session()->setFlashdata('success', 'Guru Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Guru Gagal Dibuat!');
        }

        return redirect()->to('/guru');
    }

    public function edit($id)
    {
        if (!$this->request->is('post')) {
            $teacher = $this->teacherModel->getTeacher($id);
            $subjects = $this->subjectModel->findAll();
            $teacherSubjects = $this->teacherSubjectModel->getTeacherSubject($id);

            $data = [
                'title' => 'LMS - Ubah Guru',
                'teacher' => $teacher,
                'subjects' => $subjects,
                'teacherSubjects' => $teacherSubjects,
            ];

            return view('teacher/edit', $data);
        }

        $nip = $this->request->getVar('nip');
        $oldNip = $this->request->getVar('old_nip');
        if ($oldNip == $nip) {
            $nipRules = 'required|max_length[255]';
        } else {
            $nipRules = 'required|max_length[255]|is_unique[teachers.nip]';
        }

        $rules = [
            'full_name'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'nip'    => [
                'rules' => $nipRules,
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
            'subject_id[]'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mata Pelajaran harus diisi',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        $input['old_profile_picture'] = $this->request->getVar('old_profile_picture');
        $input['user_id'] = $this->request->getVar('user_id');

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/guru/ubah/' . $id)->withInput();
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

        $teacherData = [
            'id' => $id,
            'nip' => $input['nip'],
        ];

        $this->teacherModel->save($teacherData);

        $subjectIds = $this->request->getVar('subject_id[]');
        $oldTeacherSubjects = unserialize(base64_decode($this->request->getVar('old_teacher_subject')));

        $oldTeacherSubjects = array_map(function ($teacherSubject) {
            return ['teacher_id' => $teacherSubject['teacher_id'], 'subject_id' => $teacherSubject['subject_id']];
        }, $oldTeacherSubjects);

        $teacherSubjectData = [];
        foreach ($subjectIds as $subjectId) {
            array_push($teacherSubjectData, ['teacher_id' => $id, 'subject_id' => $subjectId]);
        }

        $result = null;
        if ($oldTeacherSubjects == $teacherSubjectData) {
            $result = true;
        } else {
            $this->teacherSubjectModel
                ->where('teacher_id', $id)
                ->delete();

            $result = $this->teacherSubjectModel->insertBatch($teacherSubjectData);
        }


        if ($result) {
            session()->setFlashdata('success', 'Guru Berhasil Diubah!');
        } else {
            session()->setFlashdata('failed', 'Guru Gagal Diubah!');
        }

        return redirect()->to('/guru');
    }

    public function delete($id)
    {
        $teacher = $this->teacherModel->find($id);
        $user = $this->userModel->find($teacher['user_id']);

        // Check if our current image is our default profile image
        if ($user['profile_picture'] != 'undraw_profile.svg') {
            // Delete image in explorer
            unlink('img/profile/' . $user['profile_picture']);
        }

        $this->teacherModel->delete($id);
        $this->userModel->delete($user['id']);

        session()->setFlashdata('success', 'Guru Berhasil Dihapus!');

        return redirect()->to('/guru');
    }
}
