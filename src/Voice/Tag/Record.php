<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Record extends Voice
{
    public function __construct($maxduration = null)
    {
        parent::__construct("Record");
    }

    public function setMaxDuration($duration)
    {
        $this->setAttribute('maxduration', $duration);
    }

    public function setBeep($beep = true)
    {
        $this->setAttribute('beep', $beep);
    }

    public function getDefaultAttributes()
    {
        return [
            "beep" => true
        ];
    }
}
