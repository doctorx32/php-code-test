<?php
declare(strict_types=1);

namespace App;


final class App
{
    /**
     * @var GetBookList
     */
    private $getBookList;

    /**
     * @param GetBookList $getBookList
     */
    public function __construct(GetBookList $getBookList)
    {
        $this->getBookList = $getBookList;
    }


    public function start()
    {
        $this->getBookList->getBooksByAuthor("Rowling");
    }
}