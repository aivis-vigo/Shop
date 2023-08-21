<?php declare(strict_types=1);

namespace App\Services\Section\Delete;

class DeleteSectionRequest
{
    private int $id;

    public function __construct(array $section)
    {
        $this->id = (int)$section['id'];
    }

    public function id(): int
    {
        return $this->id;
    }
}