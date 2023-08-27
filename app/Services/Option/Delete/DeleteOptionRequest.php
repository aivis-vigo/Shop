<?php declare(strict_types=1);

namespace App\Services\Option\Delete;

class DeleteOptionRequest
{
    private int $id;

    public function __construct(array $option)
    {
        $this->id = (int)$option['id'];
    }

    public function id(): int
    {
        return $this->id;
    }
}