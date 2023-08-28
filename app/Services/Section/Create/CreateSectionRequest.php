<?php declare(strict_types=1);

namespace App\Services\Section\Create;

class CreateSectionRequest
{
    private string $title;
    private string $description;
    private string $pictureUrl;

    public function __construct(array $section)
    {
        $this->title = $section['title'];
        $this->description = $section['description'];
        $this->pictureUrl = $section['picture_url'];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function pictureUrl(): string
    {
        return $this->pictureUrl;
    }
}