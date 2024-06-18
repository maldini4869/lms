<?php

namespace App\Controllers;

use App\Models\ClassStudentModel;
use App\Models\ScheduleModel;
use App\Models\SessionItemModel;
use App\Models\StudentAssignmentModel;
use App\Models\TeacherModel;

class Scoring extends BaseController
{
    protected $sessionItemModel;
    protected $scheduleModel;
    protected $teacherModel;
    protected $classStudentModel;
    protected $studentAssignmentModel;

    public function __construct()
    {
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->teacherModel = new TeacherModel();
        $this->classStudentModel = new ClassStudentModel();
        $this->studentAssignmentModel = new StudentAssignmentModel();
    }

    public function index()
    {
        $assignmentSessionItems = $this->sessionItemModel->getSessionItems(session('user_id'), 2);

        $data = [
            'title' => 'LMS - Penilaian',
            'assignmentSessionItems' => $assignmentSessionItems
        ];
        return view('scoring/list', $data);
    }

    public function detail($sessionItemId)
    {
        $sessionItem = $this->sessionItemModel->with('sessions')->find($sessionItemId);

        $classStudents = $this->classStudentModel->with('students')
            ->where('semester_id', $sessionItem['session']['schedule']['semester_id'])
            ->where('class_id', $sessionItem['session']['schedule']['class_id'])
            ->findAll();

        $studentAssignments = $this->studentAssignmentModel
            ->where('session_item_id', $sessionItemId)
            ->findAll();

        $data = [
            'title' => 'LMS - Penilaian',
            'sessionItem' => $sessionItem,
            'classStudents' => $classStudents,
            'studentAssignments' => $studentAssignments,
        ];
        return view('scoring/detail', $data);
    }

    public function submitScoring()
    {
        $rules = [
            'id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Id harus diisi',
                ]
            ],
            'grade'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                ]
            ],
            'session_item_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                ]
            ],
            'student_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                ]
            ],
            'feedback'    => [
                'rules' => 'max_length[255]',
                'errors' => [
                    'max_length' => 'Feedback melebihi batas karakter',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/penilaian' . '/' . $input['session_item_id'])->withInput();
        }

        $result = $this->studentAssignmentModel->update($input['id'], ['grade' => $input['grade'], 'feedback' => $input['feedback']]);

        if ($result) {
            session()->setFlashdata('success', 'Tugas Berhasil Dinilai!');
        } else {
            session()->setFlashdata('failed', 'Tugas Gagal Dinilai!');
        }

        return redirect()->to('/penilaian' . '/' . $input['session_item_id']);
    }
}
