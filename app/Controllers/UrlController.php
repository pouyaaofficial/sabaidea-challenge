<?php

namespace App\Controllers;

use App\Models\Url;
use App\Models\User;
use App\Resources\UrlResource;
use Core\Request;
use Core\Response;
use Core\Validator;

class UrlController extends Controller
{
    public function index()
    {
        if (!$this->authentication()) {
            return Response::unauthorized();
        }

        $urls = Url::fetchByUserId(user()['id']);

        return Response::ok(UrlResource::collection($urls));
    }

    public function store()
    {
        if (!$this->authentication()) {
            return Response::unauthorized();
        }

        $url = Validator::asUrl(Request::get('url'));
        $hash = Url::findAvailableHash();

        Url::create([
            'user_id' => user()['id'],
            'url' => $url,
            'hash' => $hash,
        ]);

        $url = Url::getByHash($hash);

        return Response::created(new UrlResource($url));
    }

    public function update($hash)
    {
        if (!$this->authentication()) {
            return Response::unauthorized();
        }

        $result = Url::getByHash($hash);

        if (is_null($result)) {
            return Response::notFound();
        }

        $_PUT = json_decode(file_get_contents('php://input'), true);
        $url = Validator::asUrl($_PUT['url']);

        Url::updateUrlByHash($hash, $url);

        return Response::ok([]);
    }

    public function destroy($hash)
    {
        if (!$this->authentication()) {
            return Response::unauthorized();
        }

        $result = Url::getByHash($hash);

        if (is_null($result)) {
            return Response::notFound();
        }

        Url::deleteByHash($hash);

        return Response::ok([]);
    }

    public function redirect($hash)
    {
        $url = Url::getByHash($hash);

        if (is_null($url)) {
            return Response::notFound();
        }

        header('Location: '.$url['url'], true, 302);
    }

    private function authentication()
    {
        $email = Validator::asEmail($_SERVER['HTTP_EMAIL']);
        $password = Validator::asPassword($_SERVER['HTTP_PASSWORD']);

        global $user;
        $user = User::getByEmailAndPassword($email, $password);

        return !is_null($user);
    }
}
