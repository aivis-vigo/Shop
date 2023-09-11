<?php declare(strict_types=1);

namespace App\Services\Listing\Delete;

class DeleteListingRequest
{
    private int $id;

    public function __construct(array $listing)
    {
        $this->id = (int)$listing['id'];
    }

    public function id(): int
    {
        return $this->id;
    }
}