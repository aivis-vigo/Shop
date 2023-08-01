<?php declare(strict_types=1);

namespace App\Services\User\Delete;

class DeleteUserRequest
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }
}