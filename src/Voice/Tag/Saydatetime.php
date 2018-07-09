<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Saydatetime extends Voice
{
    public function __construct($time = null)
    {
        parent::__construct("SayDateTime", ['time' => $time]);
    }
}
