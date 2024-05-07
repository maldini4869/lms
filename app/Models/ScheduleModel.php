<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
    protected $table      = 'schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'class_id', 'teacher_id', 'teacher_subject_id', 'semester_id', 'day', 'start_period', 'end_period'];
    protected $useTimestamps = true;

    public function getSchedules($classId, $semesterId)
    {
        $queryBuilder = $this
            ->select('
                class.code as class_code,
                semester.semester as semester,
                subject.name as subject_name,
                user.full_name as teacher_name,
                schedule.day as day,
                schedule.start_period as start_period,
                schedule.end_period as end_period,
            ')
            ->join('class', 'class.id = schedule.class_id')
            ->join('semester', 'semester.id = schedule.semester_id')
            ->join('teacher_subject', 'teacher_subject.id = schedule.teacher_subject_id')
            ->join('subject', 'subject.id = teacher_subject.subject_id')
            ->join('teacher', 'teacher.id = teacher_subject.teacher_id')
            ->join('user', 'user.id = teacher.user_id')
            ->where('schedule.class_id', $classId)
            ->where('schedule.semester_id', $semesterId)
            ->orderBy('start_period', 'asc');

        return $queryBuilder->findAll();
    }
}
