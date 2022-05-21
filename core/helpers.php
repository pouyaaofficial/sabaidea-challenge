<?php

use Core\Database\Db;

if (!function_exists('db')) {
    function db(): Db
    {
        return Db::init();
    }
}

if (!function_exists('user')) {
    function user()
    {
        global $user;

        return $user;
    }
}
