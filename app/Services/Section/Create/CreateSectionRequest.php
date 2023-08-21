<?php declare(strict_types=1);

namespace App\Services\Section\Create;

class CreateSectionRequest
{
    private string $title;
    private string $description;

    public function __construct(array $section)
    {
        $this->title = $section['title'];
        $this->description = $section['description'];
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