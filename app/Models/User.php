<?php

namespace App\Models;

use Core\Hash;

class User
{
    public static function getByEmail($email)
    {
        return db()->first('SELECT * FROM `users` WHERE `email`=:email', [
          'email' => $email,
        ]);
    }

    public static function getById($id)
    {
        return db()->first('SELECT * FROM `users` WHERE `id`=:id', [
          'id' => $id,
        ]);
    }

    public static function create($data)
    {
        return db()->insert('INSERT INTO users (`email`, `password`) VALUES (:email, :password)', $data);
    }

    public static function getByEmailAndPassword($email, $password)
    {
        return db()->first('SELECT * FROM `users` WHERE `email`=:email AND `password`=:password', [
          'email' => $email,
          'password' => Hash::make($password),
      ]);
    }
}
