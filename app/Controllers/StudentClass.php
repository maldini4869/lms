<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\SemesterModel;
use App\Models\StudentClassModel;
use App\Models\StudentModel;

class StudentClass extends BaseController
{

    protected $classModel;
    protected $StudentClassModel;
    protected $semesterModel;
    protected $studentModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
        $this->StudentClassModel = new StudentClassModel();
        $this->studentModel = new StudentModel();
        $this->semesterModel = new SemesterModel();
    }

    public function index()
    {
        $currentSemester = get_site_settings('CURRENT_SEMESTER_ID');
        $semesterIdParam = $this->request->getVar('semester_id');
        $semesters = $this->semesterModel->findAll();

        if ($semesterIdParam) {
            $semesterId = $semesterIdParam;
        } else {
            $semesterId = $currentSemester;
        }

        $filledClasses = $this->StudentClassModel->getStudentClass(null, $semesterId);
        $classes = $this->classModel->findAll();

        foreach ($classes as $i => $class) {
            $classes[$i]['student_classes'] = array_filter($filledClasses, fn ($item) => $item['class_id'] == $class['id']);
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
        $studentClasses = array_values($this->StudentClassModel->with('students')->where('class_id', $classId)->where('semester_id', $semesterId)->findAll());
        $filteredStudentClasses = array_values($this->StudentClassModel->with('students')->where('semester_id', $semesterId)->findAll());
        $class = $this->classModel->find($classId);
        $semester = $this->semesterModel->find($semesterId);

        $mappedExistingStudentsClass = array_map(fn ($item) => $item['student'], $filteredStudentClasses);
        $existingStudentsClass = array_map('serialize', $mappedExistingStudentsClass);
        $allStudents = array_map('serialize', $this->studentModel->with('users')->findAll());
        $students = array_diff($allStudents, $existingStudentsClass);

        $data = [
            'title' => 'LMS - Detail Kelas',
            'studentClasses' => $studentClasses,
            'class' => $class,
            'semester' => $semester,
            'students' => array_map('unserialize', $students),
        ];

        return view('class_student/detail', $data);
    }

    public function addStudentClass()
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

        $result = $this->StudentClassModel->insertBatch($sessionStudentData);
        if ($result) {
            session()->setFlashdata('success', 'Siswa Berhasil Ditambahkan!');
        } else {
            session()->setFlashdata('failed', 'Siswa Gagal Ditambahkan!');
        }

        return redirect()->to("/kelas/$classId/semester/$semesterId");
    }

    public function deleteStudentClass($id)
    {
        $studentClass = $this->StudentClassModel->find($id);
        $classId = $studentClass['class_id'];
        $semesterId = $studentClass['semester_id'];

        $this->StudentClassModel->delete($id);

        session()->setFlashdata('success', 'Siswa Berhasil Berhasil Dihapus!');

        return redirect()->to("/kelas/$classId/semester/$semesterId");
    }
}
