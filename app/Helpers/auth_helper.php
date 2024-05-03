<?php

/**
 * Protect current page / controller with authentication and authorization
 */
function protect_page(array $allowedRoles)
{
    if (!is_loggeded_in()) {
        return redirect()->to('/auth/login');
    } else {
        if (!is_authorized($allowedRoles)) {
            return redirect()->to('/404');
        }
    }

    return;
}

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
    return in_array($loggedInUserRoleId, $allowedRoles);
}
