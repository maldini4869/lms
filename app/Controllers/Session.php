<?php

namespace App\Controllers;

use App\Models\ClassStudentModel;
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
    protected $classStudentModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->sessionStudentModel = new SessionStudentModel();
        $this->studentModel = new StudentModel();
        $this->classStudentModel = new ClassStudentModel();
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
        $session = $this->sessionModel->with(['schedules'])->where('id', $session_id)->first();

        $session['session_items'] = $this->sessionItemModel->with(['session_item_comments', 'student_assignments'])->where('session_id', $session['id'])->orderBy('created_at', 'desc')->findAll();

        $classStudents = $this->classStudentModel->with('students')
            ->where('semester_id', $session['schedule']['semester_id'])
            ->where('class_id', $session['schedule']['class_id'])
            ->findAll();

        $data = [
            'title' => 'LMS - Pertemuan',
            'session' => $session,
            'classStudents' => $classStudents,
        ];
        return view('session/detail', $data);
    }
}
