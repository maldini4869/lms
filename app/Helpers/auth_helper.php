<?php

/**
 * Check if user is loggedin
 */
function is_loggeded_in()
{
    return session('logged_in');
}

/**
 * Check authorization
 */
function is_authorized(array $allowedRoles)
{
    $loggedInUserRoleId = session('user_role_id');
    return in_array((string) $loggedInUserRoleId, $allowedRoles);
}
