<?php
declare(strict_types=1);

namespace App;

use App\Input\InputInterface;
use App\Output\OutputStrategy;
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
        $url = $this->router->generate('api_book_seller_by_author', [
            'authorName' => $authorName,
            'limit' => $limit,
            'format' => $this->format
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $output = $this->input->fetch($url);

        $outputStrategy = new OutputStrategy();

        return $outputStrategy->resolve($this->format, $output);
    }
}
