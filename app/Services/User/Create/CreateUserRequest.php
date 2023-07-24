<?php declare(strict_types=1);

namespace App\Services\User\Create;

class CreateUserRequest
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;

    public function __construct(array $user)
    {
        $this->firstName = $user['firstName'];
        $this->lastName = $user['lastName'];
        $this->email = $user['email'];
        $this->password = $user['password'];
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

    public function password(): string
    {
        return $this->password;
    }
}