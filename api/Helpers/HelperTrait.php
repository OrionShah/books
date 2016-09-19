<?php

namespace Helpers;

trait HelperTrait
{
    public function printVal($value)
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }

    public function vd($value)
    {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    }
}