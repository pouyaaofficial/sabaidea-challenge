<?php

namespace App\Models;

use Core\Hash;

class Url
{
    public static function getByHash($hash)
    {
        return db()->first('SELECT * FROM `urls` WHERE `hash`=:hash', [
          'hash' => $hash,
        ]);
    }

    public static function fetchByUserId($userId)
    {
        return db()->select('SELECT * FROM `urls` WHERE `user_id`=:user_id', [
            'user_id' => $userId,
        ]);
    }

    public static function create($data)
    {
        return db()->insert('INSERT INTO urls (user_id, url, hash) VALUES (:user_id, :url, :hash)', $data);
    }

    public static function updateUrlByHash($hash, $url)
    {
        return db()->update('UPDATE urls SET url=:url WHERE hash=:hash', [
            'url' => $url,
            'hash' => $hash,
        ]);
    }

    public static function deleteByHash($hash)
    {
        return db()->update('DELETE FROM urls WHERE hash=:hash', [
            'hash' => $hash,
        ]);
    }

    public static function findAvailableHash()
    {
        do {
            $hash = Hash::generate();
        } while (self::getByHash($hash));

        return $hash;
    }
}
