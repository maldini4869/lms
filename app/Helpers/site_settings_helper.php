<?php

use App\Models\SiteSettingModel;

function get_site_settings($slug)
{
    $siteSettingModel = new SiteSettingModel();
    return $siteSettingModel->getSiteSettings($slug);
}
