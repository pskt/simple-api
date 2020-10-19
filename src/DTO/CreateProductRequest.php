<?php

declare(strict_types=1);

namespace App\DTO;

final class CreateProductRequest
{
    public ?string $name;

    public ?float $price;
}
