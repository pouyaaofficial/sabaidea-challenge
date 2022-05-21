<?php

namespace Core;

class Request
{
    public static function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getHost(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

    public static function get(string $key, $default = null): mixed
    {
        return static::getParams()[$key] ?? $default;
    }

    public static function getParams(): array
    {
        if ('GET' === self::getMethod()) {
            return $_GET;
        }

        if (in_array(self::getMethod(), ['POST', 'PUT', 'PATCH'])) {
            return $_POST;
        }
    }
}
