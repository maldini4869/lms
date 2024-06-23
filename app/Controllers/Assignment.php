<?php

namespace App\Controllers;

use App\Models\StudentClassModel;
use App\Models\ScheduleModel;
use App\Models\SessionItemModel;
use App\Models\StudentAssignmentModel;
use App\Models\StudentModel;
use App\Models\TeacherModel;

class Assignment extends BaseController
{
    protected $sessionItemModel;
    protected $scheduleModel;
    protected $teacherModel;
    protected $StudentClassModel;
    protected $studentAssignmentModel;
    protected $studentModel;

    public function __construct()
    {
        $this->sessionItemModel = new SessionItemModel();
        $this->scheduleModel = new ScheduleModel();
        $this->teacherModel = new TeacherModel();
        $this->StudentClassModel = new StudentClassModel();
        $this->studentAssignmentModel = new StudentAssignmentModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        $assigmentCodeParam = $this->request->getVar('assignment_code');
        $student = $this->studentModel->where('user_id', session('user_id'))->first();

        $studentSessionItems = $this->sessionItemModel->studentSessionItems($student['id'], 2, $assigmentCodeParam);
        $studentAssignments = $this->studentAssignmentModel
            ->where('student_id', $student['id'])
            ->findAll();

        foreach ($studentSessionItems as $key => $item) {
            $assignments = array_filter($studentAssignments, fn ($studentAssignment) => $studentAssignment['session_item_id'] == $item['id'] && $studentAssignment['student_id'] == $student['id']);
            if ($assignments) {
                $assignment = array_values($assignments)[0];
            } else {
                $assignment = null;
            }

            $studentSessionItems[$key]['assignment'] = $assignment;
        }

        $data = [
            'title' => 'LMS - Tugas',
            'studentSessionItems' => $studentSessionItems
        ];
        return view('assignment/list', $data);
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
}
