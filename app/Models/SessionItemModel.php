<?php

namespace App\Models;

class SessionItemModel extends BaseModel
{
    protected $table      = 'session_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_id', 'code', 'text', 'file', 'type', 'user_id'];
    protected $useTimestamps = true;
    protected $with = ['users'];

    public function getSessionItems($user_id, $type, $semester_id = null)
    {
        $queryBuilder = $this
            ->select('
                session_items.id as id,
                session_items.code as code,
                session_items.file as file,
                session_items.text as text,
                session_items.created_at as created_at,
            ')
            ->join('sessions', 'sessions.id = session_items.session_id')
            ->join('schedules', 'schedules.id = sessions.schedule_id')
            ->where('session_items.type', $type)
            ->where('session_items.user_id', $user_id);

        if ($semester_id) {
            $queryBuilder->where('schedules.semester_id', $semester_id);
        }

        return $queryBuilder->orderBy('session_items.created_at', 'asc')->findAll();
    }
}
