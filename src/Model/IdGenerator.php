<?php

declare(strict_types=1);

namespace App\Model;

interface IdGenerator
{
    public function generate(): string;
}
