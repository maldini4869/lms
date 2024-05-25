<?php

namespace App\Models;

class TeacherSubjectModel extends BaseModel
{
    protected $table      = 'teachers_subjects';
    protected $primaryKey = 'id';
    protected $allowedFields = ['teacher_id', 'subject_id'];
    protected $useTimestamps = true;

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

    public function subject()
    {
        return $this->hasOne('App\Models\SubjectModel', 'subject_id');
    }
}
