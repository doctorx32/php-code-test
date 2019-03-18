<?php

namespace App;


class App
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