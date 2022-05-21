<?php

namespace Core;

class Response
{
    public static function json(mixed $data, string $status, $statusCode = 200): string
    {
        if ($data instanceof JsonResource) {
            $data = $data->toArray();
        }

        http_response_code($statusCode);
        header('Content-Type: application/json');

        return json_encode(['status' => $status, 'data' => $data]);
    }

    public static function jsonMessage(mixed $message, string $status, $statusCode = 200): string
    {
        return static::json(['message' => $message], $status, $statusCode);
    }

    public static function ok(mixed $data): string
    {
        return static::json($data, 'success', 200);
    }

    public static function created(mixed $data): string
    {
        return static::json($data, 'success', 201);
    }

    public static function unauthorized(): string
    {
        return static::jsonMessage('Unauthorized', 'failed', 401);
    }

    public static function notFound(): string
    {
        return static::jsonMessage('Resource not found', 'failed', 404);
    }
}
