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

    public function onFail($tag, $attribs = [])
    {
        return $this->setAttribute('onfail', $this->append($tag, $attribs), true);
    }

    public function onPass($tag, $attribs = [])
    {
        return $this->setAttribute('onpass', $this->append($tag, $attribs), true);
    }

    public function getDefaultAttributes()
    {
        return [
            'onpass' => [],
            'onfail' => []
        ];
    }
}
