<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use App\Models\SessionItemModel;
use App\Models\SessionModel;
use App\Models\SessionStudentModel;
use App\Models\StudentModel;

class Session extends BaseController
{
    protected $sessionModel;
    protected $sessionItemModel;
    protected $scheduleModel;
    protected $sessionStudentModel;
    protected $studentModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->sessionStudentModel = new SessionStudentModel();
        $this->studentModel = new StudentModel();
    }

    public function index($schedule_id)
    {
        $schedule = $this->scheduleModel->find($schedule_id);
        $subTitle = $schedule['class']['code'] . ' - ' . $schedule['teachers_subject']['subject']['name'];
        $sessions = $this->sessionModel->with('schedules')->where('schedule_id', $schedule_id)->findAll();

        $data = [
            'title' => 'LMS - Pertemuan',
            'subTitle' => $subTitle,
            'sessions' => $sessions,
        ];
        return view('session/list', $data);
    }

    public function detail($session_id)
    {
        $session = $this->sessionModel->with(['schedules', 'students'])->where('id', $session_id)->first();

        $session['session_items'] = $this->sessionItemModel->with('session_item_comments')->where('session_id', $session['id'])->orderBy('created_at', 'desc')->findAll();

        $sessionStudents = array_map('serialize', $session['students']);

        $allStudents = array_map('serialize', $this->studentModel->with('users')->findAll());

        $students = array_diff($allStudents, $sessionStudents);

        $data = [
            'title' => 'LMS - Pertemuan',
            'session' => $session,
            'students' => array_map('unserialize', $students),
        ];
        return view('session/detail', $data);
    }

    public function addStudent()
    {
        $rules = [
            'session_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Session id harus diisi',
                ]
            ],
            'student_id[]'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Siswa harus diisi',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/pertemuan/detail/' . $input['session_id'])->withInput();
        }

        $studentIds = $this->request->getVar('student_id[]');

        $sessionStudentData = [];
        foreach ($studentIds as $studentId) {
            array_push($sessionStudentData, ['session_id' => $input['session_id'], 'student_id' => $studentId]);
        }

        $result = $this->sessionStudentModel->insertBatch($sessionStudentData);
        if ($result) {
            session()->setFlashdata('success', 'Siswa Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Siswa Gagal Dibuat!');
        }

        return redirect()->to('/pertemuan/detail/' . $input['session_id']);
    }
}
