<?php

namespace Mobtexting\Voice\Tag;

use Exception;
use Mobtexting\Voice\Voice;

class Menu extends Voice
{
    protected $nested = [
        'wrongkey',
        'timeout',
        'onfail'
    ];

    public function __construct($prompt, $attribs = [])
    {
        parent::__construct("Menu", $attribs);
    }

    public function onFail($verb, $attribs = [])
    {
        return $this->setAttribute('onFail', $this->append($verb, $attribs), true);
    }

    public function onTimeout($verb, $attribs = [])
    {
        return $this->setAttribute('timeout', $this->append($verb, $attribs), true);
    }

    public function getDefaultAttributes()
    {
        return [
            'waittime' => 10,
            'maxrepeat' => 3,
            'type' => 'parallel',
            'dtmftimeout' => 3,
            'dtmftdefaultkey' => ''
        ];
    }
}
