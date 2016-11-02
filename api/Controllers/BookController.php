<?php

namespace Controllers;

class BookController extends BaseController
{
    public function getInfo($id)
    {
        $book = new \Models\BookModel($this->ci, 'book.fb2');

        return [
            "id" => intval($id),
            "name" => $book->title,
            "genres" => $book->genre_list,
            "pages" => $book->pages,
        ];
    }

    public function getPage($id, $name, $page) {
        $book = new \Models\BookModel($this->ci, 'book.fb2');

        return [
            "id" => intval($id),
            "name" => $book->title,
            "pages" => $book->pages,
            "current_page" => intval($page),
            "text" => $book->getPage($page)
        ];
    }
}
