<?php declare(strict_types=1);

namespace App\Services\User\Read;

use App\Models\User;

class ReadUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function data(): array
    {
        $user = $this->user;

        return [
            'firstName' => $user->firstName(),
            'lastName' => $user->lastName(),
            'email' => $user->email(),
            'password' => $user->password()
        ];
    }
}