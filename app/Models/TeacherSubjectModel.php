<?php

namespace App\Models;

class TeacherSubjectModel extends BaseModel
{
    protected $table      = 'teachers_subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['teacher_id', 'subject_id'];
    protected $useTimestamps = true;
    protected $with = 'subjects';

    public function getTeacherSubject($teacherId = null)
    {
        $queryBuilder = $this
            ->select('
                teachers_subjects.id as id,
                teachers_subjects.subject_id as subject_id,
                subjects.name as subject_name,
                teachers_subjects.teacher_id as teacher_id,
                users.full_name as teacher_name
            ')
            ->join('teachers', 'teachers.id = teachers_subjects.teacher_id')
            ->join('users', 'users.id = teachers.user_id')
            ->join('subjects', 'subjects.id = teachers_subjects.subject_id');

        if ($teacherId) {
            $queryBuilder->where('teacher_id', $teacherId);
        }

        return $queryBuilder->findAll();
    }

    public function checkTeacherSubjectSchedules($teacher_id, $subject_id)
    {
        $queryBuilder = $this
            ->select('
                teachers_subjects.id as id,
                teachers_subjects.teacher_id as teacher_id,
                teachers_subjects.subject_id as subject_id
            ')
            ->join('schedules', 'schedules.teacher_subject_id = teachers_subjects.id')
            ->where('teachers_subjects.teacher_id', $teacher_id)
            ->whereIn('teachers_subjects.subject_id', $subject_id);

        return $queryBuilder->findAll();
    }
}
