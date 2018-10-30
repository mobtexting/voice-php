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

    public function __construct($prompt = null, $attribs = [])
    {
        if ($prompt) {
            if (is_array($prompt)) {
                $attribs = array_merge($prompt, $attribs);
            } else {
                $attribs['prompt'] = $prompt;
            }
        }

        parent::__construct("Menu", $attribs);
    }

    public function onFail($verb, $attribs = [], $isSequential = false)
    {
        $new_tag = $this->append($verb, $attribs);
        $this->setAttribute('onfail', array($new_tag), false);
        return $new_tag;
    }

    public function onKeyPress($key, $verb, $attribs = [])
    {
        $new_tag = $this->append($verb, $attribs);
        $this->setAttribute($key, array($new_tag), false);
        return $new_tag;
    }
    public function onWrongKey($verb, $attribs = [])
    {
        $new_tag = $this->append($verb, $attribs);
        $this->setAttribute('wrongkey', array($new_tag), false);
        return $new_tag;
    }

    public function onTimeout($verb, $attribs = [], $isSequential = false)
    {
        $new_tag = $this->append($verb, $attribs);
        $this->setAttribute('timeout', array($new_tag), false);
        return $new_tag;
    }

    public function getDefaultAttributes()
    {
        return [
            'waittime'        => 10,
            'maxrepeat'       => 3,
            'type'            => 'parallel',
            'dtmftimeout'     => 3,
            'dtmfdefaultkey' => ''
        ];
    }
}
