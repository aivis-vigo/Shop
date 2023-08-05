<?php declare(strict_types=1);

namespace App\Services\Listing\Read;

class ReadListingRequest
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}