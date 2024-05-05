<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherModel extends Model
{
    protected $table      = 'teacher';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'full_name', 'nip'];
    protected $useTimestamps = true;

    public function getTeacher($id = null)
    {
        $queryBuilder = $this->select('teacher.id as id, teacher.user_id as user_id, user.email as email, user.full_name as full_name, teacher.nip as nip, user.profile_picture as profile_picture, user.phone_number as phone_number, user.is_active as is_active')->join('user', 'user.id = teacher.user_id');

        if ($id) {
            return $queryBuilder->where('teacher.id', $id)->orderBy('teacher.id', 'asc')->first();
        }

        return $queryBuilder->orderBy('teacher.id', 'asc')->findAll();
    }
}
