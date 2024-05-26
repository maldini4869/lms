<?php

namespace App\Schemas;

use Tatter\Schemas\Structures\Relation;
use Tatter\Schemas\Structures\Schema;
use Tatter\Schemas\Structures\Table;

// SCHEMA
$schema = new Schema();

// TABLES
$schema->tables->teachers_subjects = new Table('teachers_subjects');

// RELATIONS
$relation             = new Relation();
$relation->type       = 'belongsTo';
$relation->singleton  = true;
$relation->table      = 'teachers';
$relation->pivots     = [
    ['teachers_subjects', 'teacher_id', 'teachers', 'id'],
];
$schema->tables->teachers_subjects->relations->teachers = $relation;

$relation             = new Relation();
$relation->type       = 'belongsTo';
$relation->singleton  = true;
$relation->table      = 'subjects';
$relation->pivots     = [
    ['teachers_subjects', 'subject_id', 'subjects', 'id'],
];
$schema->tables->teachers_subjects->relations->subjects = $relation;

// CLEANUP
unset($relation);
