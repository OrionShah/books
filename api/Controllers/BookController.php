<?php

namespace Controllers;

class BookController extends BaseController
{
    public function getInfo($id)
    {
        return [
            "id" => $id,
            "name" => 'book'
        ];
    }
}