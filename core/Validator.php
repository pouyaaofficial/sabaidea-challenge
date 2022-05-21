<?php

namespace Core;

class Validator
{
    public static function asEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid email address');
        }

        return $email;
    }

    public static function asPassword($password)
    {
        if (strlen($password) < 8) {
            throw new \Exception('Invalid password');
        }

        return $password;
    }

    public static function asUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('Invalid url');
        }

        return $url;
    }
}
