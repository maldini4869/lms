<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherSubjectModel extends Model
{
    protected $table      = 'teacher_subject';
    protected $primaryKey = 'id';
    protected $allowedFields = ['teacher_id', 'subject_id'];
    protected $useTimestamps = true;

    public function getTeacherSubject()
    {
        $queryBuilder = $this
            ->select('
                teacher_subject.id as id,
                subject.name as subject_name,
                user.full_name as teacher_name
            ')
            ->join('teacher', 'teacher.id = teacher_subject.teacher_id')
            ->join('user', 'user.id = teacher.user_id')
            ->join('subject', 'subject.id = teacher_subject.subject_id');

        return $queryBuilder->findAll();
    }
}
