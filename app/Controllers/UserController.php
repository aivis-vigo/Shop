<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigView;
use App\Services\User\Create\CreateUserRequest;
use App\Services\User\Create\CreateUserService;
use App\Services\User\Read\ReadUserService;

class UserController
{
    public function create(): void
    {
        $request = new CreateUserRequest($_POST);

        (new CreateUserService())->execute($request);
    }

    public function show(): TwigView
    {
        $user = (new ReadUserService())->execute();

        return new TwigView('Profile/profile', [
            'user' => $user->data()
        ]);
    }

    public function update()
    {
        // Update user info
    }

    public function delete()
    {
        // Delete user
    }
}