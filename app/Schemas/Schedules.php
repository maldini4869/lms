<?php

namespace App\Schemas;

use Tatter\Schemas\Structures\Relation;
use Tatter\Schemas\Structures\Schema;
use Tatter\Schemas\Structures\Table;

// SCHEMA
$schema = new Schema();

$schema->tables->schedules = new Table('schedules');

// RELATIONS
$relation            = new Relation();
$relation->type      = 'belongsTo';
$relation->singleton = true;
$relation->table     = 'teachers_subjects';
$relation->pivots    = [
    ['schedules', 'teacher_subject_id', 'teachers_subjects', 'id'],
];
$schema->tables->schedules->relations->teachers_subjects = $relation;

// CLEANUP
unset($relation);
