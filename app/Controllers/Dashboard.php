<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use App\Models\SemesterModel;

class Dashboard extends BaseController
{

    protected $scheduleModel;
    protected $semesterModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->semesterModel = new SemesterModel();
    }

    public function index()
    {
        $data = [
            'title' => 'LMS - Dashboard Admin'
        ];
        return view('dashboard/admin', $data);
    }

    public function teacher()
    {
        $days = [1, 2, 3, 4, 5];
        $currentSemester = get_site_settings('CURRENT_SEMESTER');
        $semesterIdParam = $this->request->getVar('semester_id');

        if ($semesterIdParam) {
            $semesterId = $semesterIdParam;
        } else {
            $semesterId = $currentSemester;
        }

        $schedules = $this->scheduleModel->getSchedules((int)$semesterId, null, session('user_id'));
        $schedulesMap = [];
        foreach ($days as $day) {
            $schedulesMap[$day] = [];

            foreach ($schedules as $schedule) {
                if ($schedule['day'] == $day) {
                    $schedulesMap[$day][] = $schedule;
                }
            }
        }
        $semesters = $this->semesterModel->findAll();
        $semester = $this->semesterModel->where('id', $semesterId)->first();

        $subTitle = '';
        if ($semester) {
            $subTitle = ' | ' . ' | Semester ' . $semester['semester'];
        }

        $data = [
            'title' => 'LMS - Dashboard Guru',
            'subTitle' => $subTitle,
            'semesters' => $semesters,
            'schedules' => $schedules,
            'schedulesMap' => $schedulesMap,
            'selectedSemesterId' => $semesterId
        ];
        return view('dashboard/teacher', $data);
    }

    public function student()
    {
        $data = [
            'title' => 'LMS - Dashboard Siswa'
        ];
        return view('dashboard/student', $data);
    }
}
