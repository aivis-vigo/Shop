<?php declare(strict_types=1);

namespace App\Models;

class Section
{
    private int $id;
    private string $title;
    private string $description;

    public function __construct(array $section)
    {
        $this->id = (int)$section['id'];
        $this->title = $section['title'];
        $this->description = $section['description'];
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
}