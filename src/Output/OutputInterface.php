<?php

declare(strict_types=1);

namespace App\Output;

interface OutputInterface
{
    public function parse($output): array;
}
