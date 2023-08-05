<?php declare(strict_types=1);

namespace App\Services\Listing\Create;

class CreateListingRequest
{
    private int $optionId;
    private string $title;
    private string $description;
    private int $price;
    private string $location;

    public function __construct(array $listing)
    {
        $this->optionId = (int)$listing['option'];
        $this->title = $listing['title'];
        $this->description = $listing['description'];
        $this->price = (int)$listing['price'];
        $this->location = $listing['location'];
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

    public function price(): int
    {
        return $this->price;
    }

    public function location(): string
    {
        return $this->location;
    }
}