<?php

namespace Models;

class BookModel extends BaseModel
{
    use \Helpers\HelperTrait;

    private $ci = null;
    private $info = [];

    private $per_page = 200;

    public function __construct(\Interop\Container\ContainerInterface $ci, $name)
    {
        $this->ci = $ci;

        $this->loadInfo($name);
    }

    public function __get($name)
    {
        if (isset($this->info[$name])) {
            return $this->info[$name];
        } else {
            return null;
        }
    }

    public function loadInfo($name) {
        $doc = new \DOMDocument();
        $doc->recover = true;
        $path = $_SERVER['DOCUMENT_ROOT'] . "/" . $name;
        $load = $doc->load($path, LIBXML_NOERROR);
        if (!$load) {

            $this->ci->logger->error("Error in load book " . $name . "(" . $path . ")");
            throw new \Exception('Load book error');
        }

        $descr = $doc->getElementsByTagName('description')->item(0);
        $title_info = $descr->getElementsByTagName('title-info')->item(0);
        $genre_list = $title_info->getElementsByTagName('genre');
        $genres = [];
        foreach ($genre_list as $item) {
            $genres[] = $item->nodeValue;
        }

        $book_title = $title_info->getElementsByTagName('book-title')->item(0)->nodeValue;
        $data = $doc->getElementsByTagName('body');
        $body = $data->item(0);

        $sections = $body->getElementsByTagName('section');
        $text = '';
        for($i=3; $i <= $sections->length; $i++) {
            $text .= $sections->item($i)->nodeValue;
        }

        $pages = ceil(strlen($text)/$this->per_page);


        $data = [
            'title' => $book_title,
            'genre_list' => $genres,
            'text' => $text,
            'pages' => $pages
        ];

        $this->info = $data;
    }

    public function getPage($page, $page_length=40) {
        $page = $page - 1;
        $lines = explode("\n", wordwrap($this->text, $this->per_page, "\n"));
        $page_lines = array_slice($lines, $page*$page_length, $page_length);
        return implode("\n", $page_lines);
    }
}