<?php

namespace App\Models;

class StudentClassModel extends BaseModel
{
    protected $table      = 'student_classes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_id', 'semester_id', 'student_id'];
    protected $useTimestamps = true;

    public function getStudentClass($classId = null, $semesterId = null)
    {
        $queryBuilder = $this->db->table('classes')
            ->select('*')
            ->join('student_classes', 'student_classes.class_id = classes.id', 'left')
            ->join('students', 'student_classes.student_id = students.id', 'left');

        if ($classId) {
            $queryBuilder->where('student_classes.class_id', $classId);
        } elseif ($semesterId) {
            $queryBuilder->where('student_classes.semester_id', $semesterId);
        }

        $studentClasses = $queryBuilder->get();

        return $studentClasses->getResultArray();
    }
}
