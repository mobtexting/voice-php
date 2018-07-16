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

    public function onFail($verb, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onfail'] = array_merge($this->attributes['onfail'], array($this->append($verb, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onfail', array($this->append($verb, $attribs)), true);
        }
    }

    public function onTimeout($verb, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['timeout'] = array_merge($this->attributes['timeout'], array($this->append($verb, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('timeout', array($this->append($verb, $attribs)), true);
        }
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
