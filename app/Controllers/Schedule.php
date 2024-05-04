<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\ScheduleModel;
use App\Models\TeacherSubjectModel;

class Schedule extends BaseController
{
    protected $teacherSubjectModel;
    protected $classModel;
    protected $scheduleModel;

    protected $classId;
    protected $semester;
    protected $day;
    protected $startPeriod;
    protected $endPeriod;
    protected $teacherId;

    public function __construct()
    {
        $this->teacherSubjectModel = new TeacherSubjectModel();
        $this->classModel = new ClassModel();
        $this->scheduleModel = new ScheduleModel();
    }

    public function index()
    {
        $days = [1, 2, 3, 4, 5];
        $classId = $this->request->getVar('class_id');
        $semester = $this->request->getVar('semester');
        $schedules = $this->scheduleModel->getSchedules($classId, $semester);
        $classes = $this->classModel->findAll();
        $class = $this->classModel->where('id', $classId)->first();

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
            'title' => 'LSM - Jadwal Mapel',
            'subTitle' => $class['code'] . ' | Semester ' . $semester,
            'schedules' => $schedules,
            'schedulesMap' => $schedulesMap,
            'classes' => $classes,
        ];
        return view('schedule/list', $data);
    }

    public function add()
    {
        if (!$this->request->is('post')) {
            $teacherSubjects = $this->teacherSubjectModel->getTeacherSubject();
            $classes = $this->classModel->findAll();

            $data = [
                'title' => 'LSM - Tambah Jadwal Mapel',
                'teacherSubjects' => $teacherSubjects,
                'classes' => $classes
            ];

            return view('schedule/add', $data);
        }

        $this->classId = $this->request->getVar('class_id');
        $this->semester = $this->request->getVar('semester');
        $this->day = $this->request->getVar('day');
        $this->startPeriod = $this->request->getVar('start_period');
        $this->endPeriod = $this->request->getVar('end_period');

        $rules = [
            'class_id'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Kelas harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'teacher_subject_id'    => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Mapel - Guru harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas',
                ]
            ],
            'semester' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'Semester harus dipilih',
                    'max_length' => 'Jumlah karakter melebihi batas',
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

        $input['code'] = 'SCH-' . $this->semester . $this->classId . $this->day . $input['teacher_subject_id'] . $this->startPeriod . $this->endPeriod;

        // Check if there are overlapping schedules
        $overlappingSchedules = $this->_rulePeriod();
        if (!empty($overlappingSchedules)) {
            session()->setFlashdata('failed', 'Jadwal untuk kelas, mapel, hari, dan periode tersebut sudah dibuat');
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
            ->where('semester', $this->semester)
            ->where('day', $this->day)
            ->where('teacher_id', $this->teacherId)
            ->where('start_period <=', $this->endPeriod)
            ->where('end_period >=', $this->startPeriod)
            ->findAll();

        return $schedules;
    }
}
