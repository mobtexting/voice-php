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
        $newTag = $this->append($tag, $attribs);
        if($isSequential){
            $this->attributes['onfail'] = array_merge($this->attributes['onfail'], array($newTag) );
        }else {
            $this->setAttribute('onfail', array($newTag), true);
        }

        return $newTag;
    }

    public function onPass($tag, $attribs = [], $isSequential = false)
    {
        $newTag = $this->append($tag, $attribs);
        if($isSequential){
            $this->attributes['onpass'] = array_merge($this->attributes['onpass'], array($newTag) );
        }else {
            $this->setAttribute('onpass', array($newTag), true);
        }

        return $newTag;
    }

    public function getDefaultAttributes()
    {
        return [
            'onpass' => [],
            'onfail' => []
        ];
    }
}
