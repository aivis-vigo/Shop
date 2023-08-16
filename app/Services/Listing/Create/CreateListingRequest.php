<?php declare(strict_types=1);

namespace App\Services\Listing\Create;

class CreateListingRequest
{
    private string $author;
    private int $optionId;
    private string $optionName;
    private string $title;
    private string $description;
    private int $price;
    private string $location;

    public function __construct(string $author, array $listing)
    {
        $this->author = $author;
        $this->optionId = (int)$listing['option'];
        $this->optionName = $listing['option_name'];
        $this->title = $listing['title'];
        $this->description = $listing['description'];
        $this->price = (int)str_replace('.', '', $listing['price']);
        $this->location = $listing['location'];
    }

    public function author(): string
    {
        return $this->author;
    }

    public function optionId(): int
    {
        return $this->optionId;
    }

    public function optionName(): string
    {
        return $this->optionName;
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