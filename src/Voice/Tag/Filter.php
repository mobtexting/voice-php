<?php

namespace Mobtexting\Voice\Tag;

use Exception;
use Mobtexting\Voice\Voice;

class Filter extends Voice
{
    public function __construct($data = null, $type = 'frequency')
    {
        $supported = [
            'frequency',
            'onecall',
            'days',
            'months',
            'hours',
            'minutes',
            'dates',
            'numbers'
        ];

        if (!in_array($type, $supported)) {
            return new Exception('Invalid type');
        }

        $unit = in_array($type, ['frequency', 'onecall']) ? 'unit' : $type;
        $data = ($unit == 'unit' || is_array($data)) ? $data : [$data];

        parent::__construct("Filter", ['type' => $type, $unit => $data]);
    }

    public function onFail($tag, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onfail'] = array_merge($this->attributes['onfail'], array($this->append($tag, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onfail', array($this->append($tag, $attribs)), true);
        }
    }

    public function onPass($tag, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onpass'] = array_merge($this->attributes['onpass'], array($this->append($tag, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onpass', array($this->append($tag, $attribs)), true);
        }
    }

    public function getDefaultAttributes()
    {
        return [
            'onpass' => [],
            'onfail' => []
        ];
    }
}
