<?php

/**
 * Get days label
 */
function get_day_label($id)
{
    $dayLabel = '';
    if ($id == 1) {
        $dayLabel = 'Senin';
    } elseif ($id == 2) {
        $dayLabel = 'Selasa';
    } elseif ($id == 3) {
        $dayLabel = 'Rabu';
    } elseif ($id == 4) {
        $dayLabel = 'Kamis';
    } elseif ($id == 5) {
        $dayLabel = 'Jumat';
    }

    return $dayLabel;
}
