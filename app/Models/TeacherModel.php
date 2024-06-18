<?php

namespace App\Models;

class TeacherModel extends BaseModel
{
    protected $table      = 'teachers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'nip'];
    protected $useTimestamps = true;
    protected $with = ['users'];

    public function getTeacher($id = null)
    {
        $queryBuilder = $this->select('teachers.id as id, teachers.user_id as user_id, users.email as email, users.full_name as full_name, teachers.nip as nip, users.profile_picture as profile_picture, users.phone_number as phone_number, users.is_active as is_active')->join('user', 'users.id = teachers.user_id');

        if ($id) {
            return $queryBuilder->where('teachers.id', $id)->orderBy('teachers.id', 'asc')->first();
        }

        return $queryBuilder->orderBy('teachers.id', 'asc')->findAll();
    }
}
