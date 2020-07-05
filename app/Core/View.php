<?php

namespace App\Core;

class View
{
    public static function show(string $path, array $variables = [])
    {
        extract($variables);
        require 'app/View/' . $path;
    }
}