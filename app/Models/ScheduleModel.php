<?php

namespace App\Models;

class ScheduleModel extends BaseModel
{
    protected $table      = 'schedules';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'class_id', 'teacher_id', 'teacher_subject_id', 'semester_id', 'day', 'start_period', 'end_period'];
    protected $useTimestamps = true;
    protected $with = ['classes', 'teachers_subjects', 'teachers'];

    public function getSchedules($semesterId, $class = null, $userTeacherId = null)
    {
        $queryBuilder = $this
            ->select('
                schedules.id as id,    
                classes.id as class_id,
                classes.code as class_code,
                semesters.semester as semester,
                subjects.name as subject_name,
                users.full_name as teacher_name,
                schedules.day as day,
                schedules.start_period as start_period,
                schedules.end_period as end_period,
            ')
            ->join('classes', 'classes.id = schedules.class_id')
            ->join('semesters', 'semesters.id = schedules.semester_id')
            ->join('teachers_subjects', 'teachers_subjects.id = schedules.teacher_subject_id')
            ->join('subjects', 'subjects.id = teachers_subjects.subject_id')
            ->join('teachers', 'teachers.id = teachers_subjects.teacher_id')
            ->join('users', 'users.id = teachers.user_id')
            ->where('schedules.semester_id', $semesterId);

        if ($class && !is_array($class)) {
            $queryBuilder->where('schedules.class_id', $class);
        } elseif ($class && is_array($class)) {
            $queryBuilder->whereIn('schedules.class_id', $class);
        }

        if ($userTeacherId) {
            $queryBuilder->where('users.id', $userTeacherId);
        }


        return $queryBuilder->orderBy('start_period', 'asc')->findAll();
    }
}
