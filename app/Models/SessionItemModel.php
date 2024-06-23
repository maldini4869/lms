<?php

namespace App\Models;

class SessionItemModel extends BaseModel
{
    protected $table      = 'session_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_id', 'code', 'text', 'file', 'type', 'user_id'];
    protected $useTimestamps = true;
    protected $with = ['users'];

    public function teacherSessionItems($user_id, $type, $semester_id = null, $assigment_code = null)
    {
        $queryBuilder = $this
            ->select('
                session_items.id as id,
                session_items.code as code,
                session_items.file as file,
                session_items.code as code,
                session_items.text as text,
                session_items.created_at as created_at,
                sessions.id as session_id,
                sessions.week as session_week,
                classes.code as class_code,
                subjects.name as subject_name,
            ')
            ->join('sessions', 'sessions.id = session_items.session_id')
            ->join('schedules', 'schedules.id = sessions.schedule_id')
            ->join('teachers', 'teachers.id = schedules.teacher_id')
            ->join('users as users_teacher', 'users_teacher.id = teachers.user_id')
            ->join('teachers_subjects', 'teachers_subjects.id = schedules.teacher_subject_id')
            ->join('subjects', 'subjects.id = teachers_subjects.subject_id')
            ->join('classes', 'classes.id = schedules.class_id')
            ->where('session_items.type', $type)
            ->where('session_items.user_id', $user_id);

        if ($semester_id) {
            $queryBuilder->where('schedules.semester_id', $semester_id);
        }

        if ($assigment_code) {
            $queryBuilder->where('session_items.code', $assigment_code);
        }

        return $queryBuilder->orderBy('session_items.created_at', 'asc')->findAll();
    }

    public function studentSessionItems($student_id, $type, $assigment_code = null)
    {
        $CURRENT_SEMESTER_ID = get_site_settings('CURRENT_SEMESTER_ID');

        $queryBuilder = $this
            ->select('
                session_items.id as id,
                session_items.code as code,
                session_items.file as file,
                session_items.code as code,
                session_items.text as text,
                session_items.created_at as created_at,
                sessions.id as session_id,
                sessions.week as session_week,
                classes.code as class_code,
                users_teacher.full_name as teacher_name,
                subjects.name as subject_name,
            ')
            ->join('sessions', 'sessions.id = session_items.session_id')
            ->join('schedules', 'schedules.id = sessions.schedule_id')
            ->join('teachers', 'teachers.id = schedules.teacher_id')
            ->join('users as users_teacher', 'users_teacher.id = teachers.user_id')
            ->join('teachers_subjects', 'teachers_subjects.id = schedules.teacher_subject_id')
            ->join('subjects', 'subjects.id = teachers_subjects.subject_id')
            ->join('classes', 'classes.id = schedules.class_id')
            ->join('student_classes', 'student_classes.class_id = classes.id')
            ->where('schedules.semester_id', $CURRENT_SEMESTER_ID)
            ->where('session_items.type', $type)
            ->where('student_classes.student_id', $student_id)
            ->where('student_classes.semester_id', $CURRENT_SEMESTER_ID);

        if ($assigment_code) {
            $queryBuilder->where('session_items.code', $assigment_code);
        }

        return $queryBuilder->orderBy('session_items.created_at', 'asc')->findAll();
    }

    public function totalStudentAssignments($student_id)
    {
        $queryBuilder = $this
            ->select('
                session_items.id as id,
            ')
            ->join('sessions', 'sessions.id = session_items.session_id')
            ->join('schedules', 'schedules.id = sessions.schedule_id')
            ->join('classes', 'classes.id = schedules.class_id')
            ->join('student_classes', 'student_classes.id = classes.id')
            ->where('session_items.type', 2)
            ->where('student_classes.student_id', $student_id);

        $result = count($queryBuilder->orderBy('session_items.created_at', 'asc')->findAll());

        return $result;
    }
}
