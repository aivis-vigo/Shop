<?php declare(strict_types=1);

namespace App\Services\User\Update;

class UpdateUserRequest
{
    private string $firstName;
    private string $lastName;
    private string $email;

    public function __construct(array $user)
    {
        $this->firstName = $user['firstName'];
        $this->lastName = $user['lastName'];
        $this->email = $user['email'];
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }
}