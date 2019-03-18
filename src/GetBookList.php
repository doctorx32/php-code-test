<?php

namespace App;

class GetBookList
{
    /**
     * @var string
     */
    private $format;

    public function __construct($format = 'json')
    {
        $this->format = $format;
    }

    public function getBooksByAuthor($authorName, $limit = 10)
    {
        $result = [];

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://api.book-seller-example.com/by-author?q=" . $authorName . '&limit=' . $limit . '&format=' . $this->format);
        $output = curl_exec($curl);
        curl_close($curl);

        if ($this->format == 'json') {
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
        }
        elseif ($this->format == 'xml') {
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
        }

        return $result;
    }
}
