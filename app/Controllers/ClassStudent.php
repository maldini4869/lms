<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\SemesterModel;
use App\Models\ClassStudentModel;
use App\Models\StudentModel;

class ClassStudent extends BaseController
{

    protected $classModel;
    protected $classStudentModel;
    protected $semesterModel;
    protected $studentModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
        $this->classStudentModel = new ClassStudentModel();
        $this->studentModel = new StudentModel();
        $this->semesterModel = new SemesterModel();
    }

    public function index()
    {
        $currentSemester = get_site_settings('CURRENT_SEMESTER');
        $semesterIdParam = $this->request->getVar('semester_id');
        $semesters = $this->semesterModel->findAll();

        if ($semesterIdParam) {
            $semesterId = $semesterIdParam;
        } else {
            $semesterId = $currentSemester;
        }

        $filledClasses = $this->classStudentModel->getClassStudent(null, $semesterId);
        $classes = $this->classModel->findAll();

        foreach ($classes as $i => $class) {
            $classes[$i]['class_students'] = array_filter($filledClasses, fn ($item) => $item['class_id'] == $class['id']);
        }

        $data = [
            'title' => 'LMS - Kelas',
            'selectedSemesterId' => $semesterId,
            'semesters' => $semesters,
            'classes' => $classes,
            'filledClasses' => $filledClasses,
        ];

        return view('class_student/list', $data);
    }

    public function detail($classId, $semesterId)
    {
        $classStudents = array_values($this->classStudentModel->with('students')->where('class_id', $classId)->where('semester_id', $semesterId)->findAll());
        $class = $this->classModel->find($classId);
        $semester = $this->semesterModel->find($semesterId);

        $mappedExistingStudentsClass = array_map(fn ($item) => $item['student'], $classStudents);
        $existingStudentsClass = array_map('serialize', $mappedExistingStudentsClass);
        $allStudents = array_map('serialize', $this->studentModel->with('users')->findAll());
        $students = array_diff($allStudents, $existingStudentsClass);


        $data = [
            'title' => 'LMS - Detail Kelas',
            'classStudents' => $classStudents,
            'class' => $class,
            'semester' => $semester,
            'students' => array_map('unserialize', $students),
        ];

        return view('class_student/detail', $data);
    }

    public function addClassStudent()
    {
        $rules = [
            'class_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Class id harus diisi',
                ]
            ],
            'semester_id'    => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Semester id harus diisi',
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
        $classId = $input['class_id'];
        $semesterId = $input['semester_id'];

        if (!$this->validateData($input, $rules)) {
            return redirect()->to("/kelas/$classId/semester/$semesterId")->withInput();
        }

        $studentIds = $this->request->getVar('student_id[]');

        $sessionStudentData = [];
        foreach ($studentIds as $studentId) {
            array_push($sessionStudentData, [
                'semester_id' => $semesterId,
                'class_id' => $classId,
                'student_id' => $studentId
            ]);
        }

        $result = $this->classStudentModel->insertBatch($sessionStudentData);
        if ($result) {
            session()->setFlashdata('success', 'Siswa Berhasil Ditambahkan!');
        } else {
            session()->setFlashdata('failed', 'Siswa Gagal Ditambahkan!');
        }

        return redirect()->to("/kelas/$classId/semester/$semesterId");
    }

    public function deleteClassStudent($id)
    {
        $classStudent = $this->classStudentModel->find($id);
        $classId = $classStudent['class_id'];
        $semesterId = $classStudent['semester_id'];

        $this->classStudentModel->delete($id);

        session()->setFlashdata('success', 'Siswa Berhasil Berhasil Dihapus!');

        return redirect()->to("/kelas/$classId/semester/$semesterId");
    }
}
