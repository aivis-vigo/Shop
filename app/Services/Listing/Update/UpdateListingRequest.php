<?php declare(strict_types=1);

namespace App\Services\Listing\Update;

use http\Encoding\Stream\Deflate;

class UpdateListingRequest
{
    private int $id;
    private string $title;
    private string $description;
    private float $price;
    private string $location;

    public function __construct(array $listing)
    {
        $this->id = (int)$listing['id'];
        $this->title = $listing['title'];
        $this->description = $listing['description'];
        $this->price = (float)$listing['price'];
        $this->location = $listing['location'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function location(): string
    {
        return $this->location;
    }
}