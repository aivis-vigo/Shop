<?php declare(strict_types=1);

namespace App\Services\Listing;

class CreateListingRequest
{
    private int $optionId;
    private string $title;
    private string $description;

    public function __construct(array $listing)
    {
        $this->optionId = (int)$listing['option'];
        $this->title = $listing['title'];
        $this->description = $listing['description'];
    }

    public function optionId(): int
    {
        return $this->optionId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }
}