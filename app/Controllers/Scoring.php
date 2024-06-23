<?php

namespace App\Controllers;

use App\Models\StudentClassModel;
use App\Models\ScheduleModel;
use App\Models\SemesterModel;
use App\Models\SessionItemModel;
use App\Models\StudentAssignmentModel;
use App\Models\TeacherModel;

class Scoring extends BaseController
{
    protected $sessionItemModel;
    protected $scheduleModel;
    protected $teacherModel;
    protected $StudentClassModel;
    protected $studentAssignmentModel;
    protected $semesterModel;

    public function __construct()
    {
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->teacherModel = new TeacherModel();
        $this->StudentClassModel = new StudentClassModel();
        $this->studentAssignmentModel = new StudentAssignmentModel();
        $this->semesterModel = new SemesterModel();
    }

    public function index()
    {
        // Semester
        $currentSemesterId = get_site_settings('CURRENT_SEMESTER_ID');
        $semesterIdParam = $this->request->getVar('semester_id');

        if ($semesterIdParam) {
            $semesterId = $semesterIdParam;
        } else {
            $semesterId = $currentSemesterId;
        }
        $semesters = $this->semesterModel->findAll();

        // Code
        $assigmentCode = $this->request->getVar('assignment_code');
        $assignmentSessionItems = $this->sessionItemModel->teacherSessionItems(session('user_id'), 2, $semesterId, $assigmentCode);

        $data = [
            'title' => 'LMS - Penilaian',
            'assignmentSessionItems' => $assignmentSessionItems,
            'semesters' => $semesters,
            'semesters' => $semesters,
            'selectedSemesterId' => $semesterId

        ];
        return view('scoring/list', $data);
    }

    public function detail($sessionItemId)
    {
        $sessionItem = $this->sessionItemModel->with('sessions')->find($sessionItemId);

        $studentClasses = $this->StudentClassModel->with('students')
            ->where('semester_id', $sessionItem['session']['schedule']['semester_id'])
            ->where('class_id', $sessionItem['session']['schedule']['class_id'])
            ->findAll();

        $studentAssignments = $this->studentAssignmentModel
            ->where('session_item_id', $sessionItemId)
            ->findAll();

        $breadcrumbs = [
            [
                'label' => "Penilaian",
                'link' => '/penilaian'
            ],
            [
                'label' => "Tugas $sessionItem[code]",
            ]
        ];

        $data = [
            'title' => 'LMS - Penilaian',
            'sessionItem' => $sessionItem,
            'studentClasses' => $studentClasses,
            'studentAssignments' => $studentAssignments,
            'breadcrumbs' => $breadcrumbs,
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
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Nilai harus diisi',
                    'numeric' => 'Nilai harus berupa angka',
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

    public function download($student_assignment_id)
    {
        $assignment = $this->studentAssignmentModel->find($student_assignment_id);

        $filepath = ROOTPATH . 'public/files/session-item-assignments/' . $assignment['file'];

        return $this->response->download($filepath, null);
    }
}
