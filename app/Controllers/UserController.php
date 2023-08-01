<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\User\Create\CreateUserRequest;
use App\Services\User\Create\CreateUserService;
use App\Services\User\Delete\DeleteUserRequest;
use App\Services\User\Delete\DeleteUserService;
use App\Services\User\Read\ReadUserService;

class UserController
{
    public function create(): void
    {
        (new CreateUserService())->execute(new CreateUserRequest($_POST));
    }

    public function show(): TwigView
    {
        $user = (new ReadUserService())->execute()->data();

        return new TwigView('Profile/profile', [
            'user' => $user
        ]);
    }

    public function update()
    {
        // Update user info
    }

    public function delete(): void
    {
        $request = new DeleteUserRequest($_SESSION['email']);

        (new DeleteUserService())->execute($request->email());

        header("Location: http://localhost:8000");
    }
}