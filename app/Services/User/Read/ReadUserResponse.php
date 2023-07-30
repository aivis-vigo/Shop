<?php declare(strict_types=1);

namespace App\Services\User\Read;

class ReadUserResponse
{
    private array $user;

    public function __construct(array $user)
    {
        $this->user = $user;
    }

    public function data(): array
    {
        return $this->user;
    }
}