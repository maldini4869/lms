<?php

namespace App\Controllers;

use App\Models\SessionItemCommentModel;
use App\Models\SessionItemModel;
use App\Models\SessionModel;
use App\Models\StudentAssignmentModel;
use App\Models\StudentModel;

class SessionItem extends BaseController
{
    protected $sessionModel;
    protected $sessionItemModel;
    protected $sessionItemCommentModel;
    protected $studentModel;
    protected $studentAssignmentModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->sessionItemModel = new SessionItemModel();
        $this->sessionItemCommentModel = new SessionItemCommentModel();
        $this->studentModel = new StudentModel();
        $this->studentAssignmentModel = new StudentAssignmentModel();
    }

    public function add()
    {
        $rules = [
            'session_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Session harus diisi',
                ]
            ],
            'text'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Tulisan harus diisi',
                ]
            ],
            'file'    => [
                'rules' => 'max_size[file,5120]',
                'errors' => [
                    'max_size' => 'Ukuran file harus dibawah 5MB',
                ]
            ],
            'type'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tipe post harus diisi',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/pertemuan/detail/' . $input['session_id'])->withInput();
        }

        $file = $this->request->getFile('file');
        $fileName = null;
        if ($file->getError() != 4) {
            $fileName = $file->getName();
            $file->move('files/session-items', $fileName);
        }

        $sessionItemData = [
            'session_id' => $input['session_id'],
            'text' => $input['text'],
            'file' => $fileName,
            'type' => $input['type'],
            'user_id' => session('user_id'),
        ];

        $sessionId = $input['session_id'];

        $id = $this->sessionItemModel->insert($sessionItemData);

        if ($input['type'] == 2) {
            $result = $this->sessionItemModel->update($id, ['code' => "TGS-$id$sessionId"]);
        }

        if ($id || $result) {
            session()->setFlashdata('success', 'Posting Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Posting Gagal Dibuat!');
        }

        return redirect()->to('/pertemuan/detail/' . $input['session_id']);
    }

    public function download($session_item_id)
    {
        $sessionItem = $this->sessionItemModel->find($session_item_id);

        $filepath = ROOTPATH . 'public/files/session-items/' . $sessionItem['file'];

        return $this->response->download($filepath, null);
    }

    public function delete($session_item_id)
    {
        $sessionItem = $this->sessionItemModel->find($session_item_id);

        $filepath = ROOTPATH . 'public/files/session-items/' . $sessionItem['file'];
        unlink($filepath);

        $result = $this->sessionItemModel->delete($session_item_id);
        if ($result) {
            session()->setFlashdata('success', 'Posting Berhasil Dihapus!');
        } else {
            session()->setFlashdata('failed', 'Posting Gagal Dihapus!');
        }

        return redirect()->to('/pertemuan/detail/' . $sessionItem['session_id']);
    }

    public function comment()
    {
        $rules = [
            'session_item_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Session item harus diisi',
                ]
            ],
            'comment_text'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Tulisan harus diisi',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($input, $rules)) {
            return redirect()->to(previous_url())->withInput();
        }

        $sessionItemCommentData = [
            'session_item_id' => $input['session_item_id'],
            'comment_text' => $input['comment_text'],
            'user_id' => session('user_id'),
        ];

        $result = $this->sessionItemCommentModel->insert($sessionItemCommentData);

        if ($result) {
            session()->setFlashdata('success', 'Komen Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Komen Gagal Dibuat!');
        }

        return redirect()->to(previous_url());
    }

    public function submitAssignment()
    {
        $rules = [
            'session_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Session harus diisi',
                ]
            ],
            'session_item_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Session item harus diisi',
                ]
            ],
            'assignment_file'    => [
                'rules' => 'uploaded[assignment_file]|max_size[assignment_file,5120]',
                'errors' => [
                    'uploaded' => 'File harus dikirim',
                    'max_size' => 'Ukuran file harus dibawah 5MB',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/pertemuan/detail/' . $input['session_id'])->withInput();
        }

        $file = $this->request->getFile('assignment_file');
        $fileName = null;
        if ($file->getError() != 4) {
            $fileName = $file->getName();
            $file->move('files/session-item-assignments', $fileName);
        }

        $student = $this->studentModel->where('user_id', session('user_id'))->first();

        $studentAssignmentData = [
            'session_item_id' => $input['session_item_id'],
            'student_id' => $student['id'],
            'file' => $fileName,
        ];


        $result = $this->studentAssignmentModel->insert($studentAssignmentData);

        if ($result) {
            session()->setFlashdata('success', 'Tugas Berhasil Dikumpulkan!');
        } else {
            session()->setFlashdata('failed', 'Tugas Gagal Dikumpulkan!');
        }

        return redirect()->to('/pertemuan/detail/' . $input['session_id']);
    }
}
