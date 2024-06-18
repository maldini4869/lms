<?php

namespace App\Controllers;

use App\Models\ClassStudentModel;
use App\Models\ScheduleModel;
use App\Models\SemesterModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;

class Dashboard extends BaseController
{

    protected $scheduleModel;
    protected $semesterModel;
    protected $studentModel;
    protected $teacherModel;
    protected $classStudentModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
        $this->semesterModel = new SemesterModel();
        $this->studentModel = new StudentModel();
        $this->teacherModel = new TeacherModel();
        $this->classStudentModel = new ClassStudentModel();
    }

    public function index()
    {
        $students = $this->studentModel->findAll();
        $teachers = $this->teacherModel->findAll();
        $data = [
            'title' => 'LMS - Dashboard Admin',
            'countStudents' => count($students),
            'countTeachers' => count($teachers)
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

        $schedules = $this->scheduleModel->getSchedules($semesterId, null, session('user_id'));
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
        $days = [1, 2, 3, 4, 5];
        $currentSemester = get_site_settings('CURRENT_SEMESTER');
        $semesterIdParam = $this->request->getVar('semester_id');
        if ($semesterIdParam) {
            $semesterId = $semesterIdParam;
        } else {
            $semesterId = $currentSemester;
        }
        $semester = $this->semesterModel->find($semesterId);

        $student = $this->studentModel->where('user_id', session('user_id'))->first();

        $classStudents = array_values($this->classStudentModel
            ->where('semester_id', $semesterId)
            ->where('student_id', $student['id'])
            ->findAll());

        $classIds = array_map(fn ($classStudent) => $classStudent['class_id'], $classStudents);

        $schedules = $this->scheduleModel->getSchedules($semesterId, $classIds);
        $schedulesMap = [];
        foreach ($days as $day) {
            $schedulesMap[$day] = [];

            foreach ($schedules as $schedule) {
                if ($schedule['day'] == $day) {
                    $schedulesMap[$day][] = $schedule;
                }
            }
        }

        $data = [
            'title' => 'LMS - Dashboard Siswa',
            'semester' => $semester,
            'schedules' => $schedules,
            'schedulesMap' => $schedulesMap,
        ];
        return view('dashboard/student', $data);
    }
}
