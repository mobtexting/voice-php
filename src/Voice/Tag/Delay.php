<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Delay extends Voice
{
    public function __construct($seconds = 0)
    {
        parent::__construct("Delay", ['seconds' => intval($seconds)]);
    }

    public function setSeconds($seconds = 0)
    {
        return $this->setAttribute('seconds', intval($seconds));
    }
}
