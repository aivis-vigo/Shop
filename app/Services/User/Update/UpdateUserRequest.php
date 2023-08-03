<?php declare(strict_types=1);

namespace App\Services\User\Update;

class UpdateUserRequest
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;

    public function __construct(int $id, array $user)
    {
        $this->id = $id;
        $this->firstName = $user['firstName'];
        $this->lastName = $user['lastName'];
        $this->email = $user['email'];
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
}