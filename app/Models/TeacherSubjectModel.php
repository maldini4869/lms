<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherSubjectModel extends Model
{
    protected $table      = 'teacher_subject';
    protected $primaryKey = 'id';
    protected $allowedFields = ['teacher_id', 'subject_id'];
    protected $useTimestamps = true;

    public function getTeacherSubject($teacherId = null)
    {
        $queryBuilder = $this
            ->select('
                teacher_subject.id as id,
                teacher_subject.subject_id as subject_id,
                subject.name as subject_name,
                teacher_subject.teacher_id as teacher_id,
                user.full_name as teacher_name
            ')
            ->join('teacher', 'teacher.id = teacher_subject.teacher_id')
            ->join('user', 'user.id = teacher.user_id')
            ->join('subject', 'subject.id = teacher_subject.subject_id');

        if ($teacherId) {
            $queryBuilder->where('teacher_id', $teacherId);
        }

        return $queryBuilder->findAll();
    }
}
