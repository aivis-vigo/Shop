<?php declare(strict_types=1);

namespace App\Services\Option\Read;

class ReadOptionResponse
{
    private array $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function options(): array
    {
        return $this->options;
    }
}