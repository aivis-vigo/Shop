<?php declare(strict_types=1);

namespace App\Services\Option\Create;

class CreateOptionRequest
{
    private int $sectionId;
    private string $title;
    private string $pictureUrl;

    public function __construct(array $option)
    {
        $this->sectionId = (int)$option['section_id'];
        $this->title = $option['title'];
        $this->pictureUrl = $option['cover_url'];
    }

    public function sectionId(): int
    {
        return $this->sectionId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function pictureUrl(): string
    {
        return $this->pictureUrl;
    }
}