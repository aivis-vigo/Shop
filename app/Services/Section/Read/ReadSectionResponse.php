<?php declare(strict_types=1);

namespace App\Services\Section\Read;

class ReadSectionResponse
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function data(): array
    {
        return $this->data;
    }
}