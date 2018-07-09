<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;
use Mobtexting\Voice\Attribute;

class Hangup extends Voice
{
    public function __construct($reason = 16)
    {
        parent::__construct("Hangup", ['reason' => 16]);
    }

    public function setReason($reason)
    {
        return $this->setAttribute('reason', $reason);
    }
}
