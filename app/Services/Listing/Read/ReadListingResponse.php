<?php declare(strict_types=1);

namespace App\Services\Listing\Read;

class ReadListingResponse
{
    private array $listings;

    public function __construct(array $listings)
    {
        $this->listings = $listings;
    }

    public function listings(): array
    {
        return $this->listings;
    }
}