<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Answer extends Voice
{
    public function __construct($delay = 0)
    {
        parent::__construct("Answer", ['delay' => intval($delay)]);
    }

    public function setDelay($delay = 0)
    {
        return $this->setAttribute('delay', intval($delay));
    }
}
