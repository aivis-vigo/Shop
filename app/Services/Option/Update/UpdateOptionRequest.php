<?php declare(strict_types=1);

namespace App\Services\Option\Update;

class UpdateOptionRequest
{
    private int $id;
    private string $title;

    public function __construct(array $option)
    {
        $this->id = (int)$option['id'];
        $this->title = $option['title'];
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
}