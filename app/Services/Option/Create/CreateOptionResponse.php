<?php declare(strict_types=1);

namespace App\Services\Option\Create;

class CreateOptionResponse
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->message;
    }
}