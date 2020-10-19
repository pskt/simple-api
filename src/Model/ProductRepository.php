<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\Product;

interface ProductRepository
{
    public function add(Product $product): void;
}
