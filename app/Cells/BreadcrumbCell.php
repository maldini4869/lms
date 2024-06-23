<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class BreadcrumbCell extends Cell
{
    public $breadcrumbs;

    protected string $view = 'breadcrumb/index';
}
