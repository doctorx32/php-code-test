<?php

declare(strict_types=1);

namespace App\Output;

use SimpleXMLElement;

final class XmlOutput implements OutputInterface
{
    public function parse($output): array
    {
        $result = [];
        $xml = new SimpleXMLElement($output);

        foreach ($xml as $result) {
            $result[] = [
                'title' => $result->book['name'],
                'author' => $result->book['author_name'],
                'isbn' => $result->book['isbn_number'],
                'quantity' => $result->book->stock['number'],
                'price' => $result->book->stock['unit_price'],
            ];
        }

        return $result;
    }
}
