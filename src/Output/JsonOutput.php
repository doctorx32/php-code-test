<?php

declare(strict_types=1);

namespace App\Output;

final class JsonOutput implements OutputInterface
{
    public function parse($output): array
    {
        $result = [];
        $json = json_decode($output);

        foreach ($json as $result) {
            $result[] = [
                'title' => $result->book->title,
                'author' => $result->book->author,
                'isbn' => $result->book->isbn,
                'quantity' => $result->stock->level,
                'price' => $result->stock->price,
            ];
        }

        return $result;
    }
}
