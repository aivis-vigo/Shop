<?php declare(strict_types=1);

namespace App\Services\Option\Update;

class UpdateOptionRequest
{
    private int $id;
    private string $title;
    private string $pictureUrl;

    public function __construct(array $option)
    {
        $this->id = (int)$option['id'];
        $this->title = $option['title'];
        $this->pictureUrl = $option['picture_url'];
    }

    public function id(): int
    {
        return $this->id;
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