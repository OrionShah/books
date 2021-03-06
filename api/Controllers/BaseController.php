<?php

namespace Controllers;



class BaseController
{
    // Подключаем трейт со всякими полезными функциями
    use \Helpers\HelperTrait;

    public $ci = null;
    public $logger = null;

    public function __construct(\Interop\Container\ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function __invoke($request, $response, $args)
    {
        // получение метода запроса
        $method = strtolower($request->getMethod());
        // получение требуемой функции
        $func = ucwords($args['name']);
        // формируем нужное название
        $full = $method . $func;
//        $this->ci->logger->info("Request to " . $full);
        // делаем запрос, распаковывая массив параметров
        $res = $this->{$full}(...array_values($args));
        $json = json_encode($res);
        return $response->withHeader('Content-type', 'application/json')
            ->write($json);
    }
}