<?php
declare(strict_types=1);

namespace App;

use App\Input\InputInterface;
use SimpleXMLElement;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

final class GetBookList
{
    /**
     * @var string
     */
    private $format;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var InputInterface
     */
    private $input;

    public function __construct(RouterInterface $router, InputInterface $input, $format = 'json')
    {
        $this->format = $format;
        $this->router = $router;
        $this->input = $input;
    }

    public function getBooksByAuthor($authorName, $limit = 10)
    {
        $result = [];

        $output = $this->input->fetch($this->router->generate('api_book_seller', [
            'authorName' => $authorName,
            'limit' => 10,
            'format' => $this->format
        ], UrlGeneratorInterface::ABSOLUTE_URL));

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
