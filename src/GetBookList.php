<?php
declare(strict_types=1);

namespace App;

use App\Input\InputInterface;
use App\Output\JsonOutput;
use App\Output\XmlOutput;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class GetBookList
{
    /**
     * @var string
     */
    private $format;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var Router
     */
    private $router;

    public function __construct(InputInterface $input, Router $router, $format = 'json')
    {
        $this->format = $format;
        $this->input = $input;
        $this->router = $router;
    }

    public function getBooksByAuthor($authorName, $limit = 10)
    {
        $result = [];

        $url = $this->router->generate('api_book_seller', [
            'authorName' => $authorName,
            'limit' => $limit,
            'format' => $this->format
        ], UrlGeneratorInterface::ABSOLUTE_URL);
        $output = $this->input->fetch($url);

        if ($this->format == 'json') {
            $jsonOutput = new JsonOutput();
            $result = $jsonOutput->parse($output);
        }
        elseif ($this->format == 'xml') {
            $xmlOutput = new XmlOutput();
            $result = $xmlOutput->parse($output);
        }

        return $result;
    }
}
