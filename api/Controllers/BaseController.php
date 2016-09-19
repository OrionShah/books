<?php

namespace Controllers;


class BaseController
{
    use \Helpers\HelperTrait;

    private $ci = null;
    
    public function __construct(\Interop\Container\ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function __invoke($request, $response, $args)
    {
        $method = strtolower($request->getMethod());
        $func = ucwords($args['name']);
        $full = $method . $func;
        $res = $this->{$full}(...array_values($args));
        $json = json_encode($res);
        return $response->withHeader('Content-type', 'application/json')
            ->write($json);
    }
}