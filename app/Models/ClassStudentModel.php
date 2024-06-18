<?php

namespace App\Models;

class ClassStudentModel extends BaseModel
{
    protected $table      = 'class_students';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_id', 'semester_id', 'student_id'];
    protected $useTimestamps = true;

    public function getClassStudent($classId = null, $semesterId = null)
    {
        $queryBuilder = $this->db->table('classes')
            ->select('*')
            ->join('class_students', 'class_students.class_id = classes.id', 'left')
            ->join('students', 'class_students.student_id = students.id', 'left');

        if ($classId) {
            $queryBuilder->where('class_students.class_id', $classId);
        } elseif ($semesterId) {
            $queryBuilder->where('class_students.semester_id', $semesterId);
        }

        $classStudents = $queryBuilder->get();

        return $classStudents->getResultArray();
    }
}
