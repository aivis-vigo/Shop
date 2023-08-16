<?php declare(strict_types=1);

namespace App\Models;

class User
{
    private ?int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private int $number;
    private string $password;

    public function __construct(
        ?int $id,
        string $firstName,
        string $lastName,
        string $email,
        int $number,
        string $password
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->number = $number;
        $this->password = $password;
    }

    public function id(): int
    {
        return $this->id;
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
}