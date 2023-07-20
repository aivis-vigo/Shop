<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private string $firstName;
    private string $lastName;
    private string $password;
    private string $secureKey;

    public function __construct(
        string $firstName,
        string $lastName,
        string $password,
        string $secureKey
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->secureKey = $secureKey;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function secureKey(): string
    {
        return $this->secureKey;
    }
}