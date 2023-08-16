<?php declare(strict_types=1);

namespace App\Services\User\Create;

class CreateUserRequest
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private int $number;
    private string $password;
    private string $confirmPassword;

    public function __construct(array $user)
    {
        $this->firstName = $user['firstName'];
        $this->lastName = $user['lastName'];
        $this->email = $user['email'];
        $this->number = (int)$user['number'];
        $this->password = $user['password'];
        $this->confirmPassword = $user['confirm-password'];
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

    public function number(): int
    {
        return $this->number;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function confirmPassword(): string
    {
        return $this->confirmPassword;
    }
}