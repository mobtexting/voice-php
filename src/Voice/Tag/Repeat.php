<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;
use Mobtexting\Voice\Attribute;

class Repeat extends Voice
{
    public function __construct($reset = false)
    {
        parent::__construct("Repeat", ['reset' => $reset]);
    }

    public function setReset($reset = true)
    {
        return $this->setAttribute('reset', $reset);
    }
}
