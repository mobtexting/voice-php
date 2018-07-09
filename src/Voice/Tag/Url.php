<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Url extends Voice
{
    public function __construct($url = null, $response = [])
    {
        $attrib = ['url' => $url, 'response' => $response];
        parent::__construct("Url", $attrib);
    }

    public function onResponse($value, $tag)
    {
        return $this->setAttribute([
            'response' => [$value => $this->append($tag)]
        ], null, true);
    }

    public function getDefaultAttributes()
    {
        return [
            "method" => "get"
        ];
    }
}
