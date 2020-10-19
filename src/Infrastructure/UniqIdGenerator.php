<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Model\IdGenerator;

class UniqIdGenerator implements IdGenerator
{
    public function generate(): string
    {
        return uniqid();
    }
}
