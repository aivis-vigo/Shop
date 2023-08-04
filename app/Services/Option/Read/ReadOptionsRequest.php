<?php declare(strict_types=1);

namespace App\Services\Option\Read;

class ReadOptionsRequest
{
    private int $section;

    public function __construct(int $section)
    {
        $this->section = $section;
    }

    public function id(): int
    {
        return $this->section;
    }
}