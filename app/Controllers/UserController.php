<?php

namespace App\Controllers;

use App\Models\User;
use App\Resources\UserResource;
use Core\Hash;
use Core\Request;
use Core\Response;
use Core\Validator;

class UserController extends Controller
{
    public function store()
    {
        $email = Validator::asEmail(Request::get('email'));
        $password = Validator::asPassword(Request::get('password'));

        $user = User::getByEmail($email);

        if (empty($user)) {
            $id = User::create(['email' => $email, 'password' => Hash::make($password)]);
            $user = User::getById($id);
        }

        return Response::created(new UserResource($user));
    }
}
