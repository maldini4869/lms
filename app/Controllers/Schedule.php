<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\ScheduleModel;
use App\Models\SemesterModel;
use App\Models\TeacherSubjectModel;

class Schedule extends BaseController
{
    protected $teacherSubjectModel;
    protected $classModel;
    protected $semesterModel;
    protected $scheduleModel;

    protected $classId;
    protected $semesterId;
    protected $day;
    protected $startPeriod;
    protected $endPeriod;
    protected $teacherId;

    public function __construct()
    {
        $this->teacherSubjectModel = new TeacherSubjectModel();
        $this->classModel = new ClassModel();
        $this->semesterModel = new SemesterModel();
        $this->scheduleModel = new ScheduleModel();
    }

    public function index()
    {
        $days = [1, 2, 3, 4, 5];
        $classId = $this->request->getVar('class_id');
        $semesterId = $this->request->getVar('semester_id');
        $schedules = $this->scheduleModel->getSchedules($classId, $semesterId);
        $classes = $this->classModel->findAll();
        $semesters = $this->semesterModel->findAll();
        $class = $this->classModel->where('id', $classId)->first();
        $semester = $this->semesterModel->where('id', $semesterId)->first();

        $schedulesMap = [];
        foreach ($days as $day) {
            $schedulesMap[$day] = [];

            foreach ($schedules as $schedule) {
                if ($schedule['day'] == $day) {
                    $schedulesMap[$day][] = $schedule;
                }
            }
        }

        $subTitle = '';
        if ($class) {
            $subTitle = ' | ' . $class['code'] . ' | Semester ' . $semester['semester'];
        }

        $data = [
            'title' => 'LMS - Jadwal Mapel',
            'subTitle' => $subTitle,
            'schedules' => $schedules,
            'schedulesMap' => $schedulesMap,
            'classes' => $classes,
            'semesters' => $semesters,
            'selectedClassId' => $classId,
            'selectedSemesterId' => $semesterId
        ];
        return view('schedule/list', $data);
    }

    public function add()
    {
        if (!$this->request->is('post')) {
            $teacherSubjects = $this->teacherSubjectModel->getTeacherSubject();
            $classes = $this->classModel->findAll();
            $semesters = $this->semesterModel->findAll();

            $data = [
                'title' => 'LMS - Tambah Jadwal Mapel',
                'teacherSubjects' => $teacherSubjects,
                'classes' => $classes,
                'semesters' => $semesters,
            ];

            return view('schedule/add', $data);
        }

        $this->classId = $this->request->getVar('class_id');
        $this->semesterId = $this->request->getVar('semester_id');
        $this->day = $this->request->getVar('day');
        $this->startPeriod = $this->request->getVar('start_period');
        $this->endPeriod = $this->request->getVar('end_period');

        $rules = [
            'class_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas harus dipilih',
                ]
            ],
            'teacher_subject_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mapel - Guru harus dipilih',
                ]
            ],
            'semester_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semester harus dipilih',
                ]
            ],
            'day' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Hari harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'start_period'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Periode Mulai harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas'
                ]
            ],
            'end_period'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Periode Selesai harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
        ];

        $input = $this->request->getPost(array_keys($rules));

        if (!$this->validateData($input, $rules)) {
            return redirect()->to('/jadwal-mapel/tambah')->withInput();
        }

        $teacherSubject = $this->teacherSubjectModel->find($input['teacher_subject_id']);
        $this->teacherId = $teacherSubject['teacher_id'];
        $input['teacher_id'] = $teacherSubject['teacher_id'];

        $input['code'] = 'SCH-' . $this->semesterId . $this->classId . $this->day . $input['teacher_subject_id'] . $this->startPeriod . $this->endPeriod;

        // Check if there are overlapping schedules
        $overlappingSchedules = $this->_rulePeriod();
        if (!empty($overlappingSchedules)) {
            session()->setFlashdata('failed', 'Jadwal untuk kelas, mapel, hari, dan periode tersebut sudah ada');
            return redirect()->to('/jadwal-mapel/tambah');
        }

        $result = $this->scheduleModel->insert($input, false);
        if ($result) {
            session()->setFlashdata('success', 'Jadwal Berhasil Dibuat!');
        } else {
            session()->setFlashdata('failed', 'Jadwal Gagal Dibuat!');
        }

        return redirect()->to('/jadwal-mapel');
    }

    public function _rulePeriod()
    {
        $schedules = $this->scheduleModel
            ->where('semester_id', $this->semesterId)
            ->where('day', $this->day)
            ->where('teacher_id', $this->teacherId)
            ->where('start_period <=', $this->endPeriod)
            ->where('end_period >=', $this->startPeriod)
            ->findAll();

        return $schedules;
    }
}
