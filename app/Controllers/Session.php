<?php

namespace App\Controllers;

use App\Models\StudentClassModel;
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
    protected $StudentClassModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->sessionStudentModel = new SessionStudentModel();
        $this->studentModel = new StudentModel();
        $this->StudentClassModel = new StudentClassModel();
    }

    public function index($schedule_id)
    {
        $schedule = $this->scheduleModel->find($schedule_id);
        $subTitle = $schedule['class']['code'] . ' - ' . $schedule['teachers_subject']['subject']['name'];
        $sessions = $this->sessionModel->with('schedules')->where('schedule_id', $schedule_id)->findAll();

        if (session('user_role_id') == 2) {
            $dashboard = 'guru';
        } else if (session('user_role_id') == 3) {
            $dashboard = 'siswa';
        }

        $breadcrumbs = [
            [
                'label' => "Pertemuan",
                'link' => "/dashboard/$dashboard"
            ],
            [
                'label' => $subTitle,
            ]
        ];

        $data = [
            'title' => 'LMS - Pertemuan',
            'subTitle' => $subTitle,
            'sessions' => $sessions,
            'breadcrumbs' => $breadcrumbs,
        ];
        return view('session/list', $data);
    }

    public function detail($session_id)
    {
        $session = $this->sessionModel->with(['schedules'])->where('id', $session_id)->first();

        $session['session_items'] = $this->sessionItemModel->with(['session_item_comments', 'student_assignments'])->where('session_id', $session['id'])->orderBy('created_at', 'desc')->findAll();

        $studentClasses = $this->StudentClassModel->with('students')
            ->where('semester_id', $session['schedule']['semester_id'])
            ->where('class_id', $session['schedule']['class_id'])
            ->findAll();

        $subTitle = $session['schedule']['class']['code'] . ' - ' . $session['schedule']['teachers_subject']['subject']['name'];

        $scheduleId = $session['schedule']['id'];

        if (session('user_role_id') == 2) {
            $dashboard = 'guru';
        } else if (session('user_role_id') == 3) {
            $dashboard = 'siswa';
        }

        $breadcrumbs = [
            [
                'label' => "Pertemuan",
                'link' => "/dashboard/$dashboard"
            ],
            [
                'label' => $subTitle,
                'link' => "/pertemuan/$scheduleId"
            ],
            [
                'label' => "Pertemuan ke $session[week]",
                'link' => '/pertemuan/guru'
            ]
        ];

        $data = [
            'title' => 'LMS - Pertemuan',
            'session' => $session,
            'studentClasses' => $studentClasses,
            'breadcrumbs' => $breadcrumbs,
        ];
        return view('session/detail', $data);
    }
}
