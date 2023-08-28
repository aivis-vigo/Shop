<?php declare(strict_types=1);

namespace App\Services\Section\Update;

class UpdateSectionRequest
{
    private int $id;
    private string $title;
    private string $description;
    private string $pictureUrl;

    public function __construct(array $section)
    {
        $this->id = (int)$section['id'];
        $this->title = $section['title'];
        $this->description = $section['description'];
        $this->pictureUrl = $section['picture_url'];
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

    public function pictureUrl(): string
    {
        return $this->pictureUrl;
    }
}