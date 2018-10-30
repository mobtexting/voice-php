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
        $new_tag = $this->append($tag);
        $this->setAttribute([
            'response' => [$value => array($new_tag)]
        ], null, true);
        return $new_tag;
    }

    public function getDefaultAttributes()
    {
        return [
            "method" => "get"
        ];
    }
}
