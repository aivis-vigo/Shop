<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\Redirect;
use App\Core\TwigView;
use App\Services\User\Create\CreateUserRequest;
use App\Services\User\Create\CreateUserService;
use App\Services\User\Delete\DeleteUserRequest;
use App\Services\User\Delete\DeleteUserService;
use App\Services\User\Password\UpdatePasswordRequest;
use App\Services\User\Password\UpdatePasswordService;
use App\Services\User\Read\ReadUserRequest;
use App\Services\User\Read\ReadUserService;
use App\Services\User\Update\UpdateUserRequest;
use App\Services\User\Update\UpdateUserService;

class UserController
{
    public function create(): Redirect
    {
        $user = $_POST;

        (new CreateUserService())->execute(new CreateUserRequest($user));

        return new Redirect('/profile');
    }

    public function show(): TwigView
    {
        $email = $_SESSION['email'];

        $user = (new ReadUserService())->execute(new ReadUserRequest($email));

        return new TwigView('Profile/profile', [
            'authorized' => isset($_SESSION['authorized']),
            'user' => $user->data()
        ]);
    }

    public function updateInfo(): Redirect
    {
        $id = $_SESSION['id'];
        $data = $_POST;

        (new UpdateUserService())->execute(new UpdateUserRequest($id, $data));

        return new Redirect('/profile');
    }

    public function updatePassword(): Redirect
    {
        $id = $_SESSION['id'];
        $passwords = $_POST;

        (new UpdatePasswordService())->execute(new UpdatePasswordRequest($id, $passwords));

        return new Redirect('/profile');
    }

    public function delete(): Redirect
    {
        (new DeleteUserService())->execute(new DeleteUserRequest($_SESSION['email']));

        return new Redirect('/');
    }
}