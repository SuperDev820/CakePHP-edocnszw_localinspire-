<?php

// TODO: use namespace:
// namespace Minifier;
// use Minifier\TinyHtmlMinifier;

// require 'TinyHtmlMinifier.php';
namespace App\Utility;

class TinyMinify
{
    public static function html(string $html, array $options = []) : string
    {
        $minifier = new TinyHtmlMinifier($options);
        return $minifier->minify($html);
    }
}
