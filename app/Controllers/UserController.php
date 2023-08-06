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
    public function create(): void
    {
        (new CreateUserService())->execute(new CreateUserRequest($_POST));
    }

    public function show(): TwigView
    {
        $user = (new ReadUserService())->execute(new ReadUserRequest($_SESSION['email']))->data();

        return new TwigView('Profile/profile', [
            'authorized' => isset($_SESSION['authorized']),
            'user' => $user
        ]);
    }

    public function update(): Redirect
    {
        $id = $_SESSION['id'];

        (new UpdateUserService())->execute(new UpdateUserRequest($id, $_POST));

        return new Redirect('/profile');
    }

    public function updatePassword(): Redirect
    {
        $id = $_SESSION['id'];

        (new UpdatePasswordService())->execute(new UpdatePasswordRequest($id, $_POST));

        return new Redirect('/profile');
    }

    public function delete(): Redirect
    {
        $request = new DeleteUserRequest($_SESSION['email']);

        (new DeleteUserService())->execute($request->email());

        return new Redirect('/');
    }
}