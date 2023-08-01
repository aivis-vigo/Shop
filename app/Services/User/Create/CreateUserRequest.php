<?php declare(strict_types=1);

namespace App\Services\User\Create;

class CreateUserRequest
{
    public array $userInfo;

    public function __construct(array $user)
    {
        $this->userInfo = $user;
    }

    public function userInfo(): array
    {
        return $this->userInfo;
    }
}