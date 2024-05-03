<?php

/**
 * Checks if a validation error exist'.
 */
function validation_has_error($key)
{
    $errors = session()->get('_ci_validation_errors');
    return $errors && array_key_exists($key, $errors);
}

/**
 * Gets validation error'.
 */
function validation_get_error($key)
{
    $errors = session()->get('_ci_validation_errors');
    return $errors && array_key_exists($key, $errors) ? $errors[$key] : '';
}
