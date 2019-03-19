<?php

namespace App\Input;

interface InputInterface
{
    public function fetch($url): array;
}