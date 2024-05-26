<?php

namespace App\Models;

class SessionItemCommentModel extends BaseModel
{
    protected $table      = 'session_item_comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['session_item_id', 'comment_text', 'user_id'];
    protected $useTimestamps = true;
    protected $with = 'users';
}
