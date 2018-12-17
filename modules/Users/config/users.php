<?php

return [
    /**
     * disable_registration => route for registration and all links in default views will be removed from system
     * disable_reset_password => user would not be able to reset password without login(route and links in default views - removed)
     * disable_reset_password_alone => user would not be able init reset password with "forget password" form(route and links in default views - removed)
     */
    'disable_registration' => false,
    'disable_reset_password' => false,
    'disable_reset_password_alone' => false,
    /**
     * active_status => array of int, each int represent value of user.status, only user with status from this list will be treated as active (can login etc.)
     */
    'active_status' => [1],
    /**
     * register_logins => bool value; If true it register all login attempt. Work only with default Users.
     */
    'register_logins' => true,
    /**
     * names of statuses
     */
    "statuses" => [
        'active'
    ],
];
