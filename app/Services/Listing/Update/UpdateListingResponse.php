<?php declare(strict_types=1);

namespace App\Services\Listing\Update;

class UpdateListingResponse
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