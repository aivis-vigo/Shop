<?php declare(strict_types=1);

namespace App\Controllers;

use App\Services\User\Create\CreateUserRequest;
use App\Services\User\Create\CreateUserService;

class UserController
{
    public function create(): void
    {
        $request = new CreateUserRequest($_POST);

        (new CreateUserService())->execute($request);
    }

    public function read()
    {
        // Get user info
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