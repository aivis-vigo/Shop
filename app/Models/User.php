<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
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