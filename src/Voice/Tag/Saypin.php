<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Saypin extends Voice
{
    public function __construct($pin = null)
    {
        $type = \is_numeric($type) ? 'numeric' : 'alphanumeric';
        parent::__construct("SayPin", ['pin' => $pin, 'type' => $type]);
    }

    public function setType($type)
    {
        return $this->setAttribute('type', $type);
    }

    public function getDefaultAttributes()
    {
        return [
            "type" => "numeric"
        ];
    }
}
