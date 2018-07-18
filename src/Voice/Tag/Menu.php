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
        $newTag = $this->append($verb, $attribs);
        if($isSequential){
            $this->attributes['onfail'] = array_merge($this->attributes['onfail'], array($newTag) );
        }else {
            $this->setAttribute('onfail', array($newTag), true);
        }
        return $newTag;
    }

    public function onTimeout($verb, $attribs = [], $isSequential = false)
    {
        $newTag = $this->append($verb, $attribs);
        if($isSequential){
            $this->attributes['timeout'] = array_merge($this->attributes['timeout'], array($newTag) );
        }else {
            $this->setAttribute('timeout', array($newTag), true);
        }

        return $newTag;
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
