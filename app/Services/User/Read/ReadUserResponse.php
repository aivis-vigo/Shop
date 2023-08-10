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
        return [
            'id' => $this->user->id(),
            'firstName' => $this->user->firstName(),
            'lastName' => $this->user->lastName(),
            'email' => $this->user->email(),
            'password' => $this->user->password()
        ];
    }
}