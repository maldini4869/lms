<?php

namespace App\Models;

class SiteSettingModel extends BaseModel
{
    protected $table      = 'site_settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['slug', 'value'];
    protected $useTimestamps = true;

    public function getSiteSettings($slug)
    {
        $siteSetting = $this->where('slug', $slug)->first();

        $value = $siteSetting['value'];

        return $value;
    }
}
