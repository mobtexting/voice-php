<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Say extends Voice
{
    public function __construct($message = null)
    {
        parent::__construct("SayText", ['message' => $message]);
    }

    public function setLanguage($language = "EN")
    {
        return $this->setAttribute('language', strtoupper($language));
    }

    public function getDefaultAttributes()
    {
        return [
            'language' => 'EN',
            "engine" => "polly"
        ];
    }
}
