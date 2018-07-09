<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Play extends Voice
{
    public function __construct($url = null, $attribs = [])
    {
        $ext = \strrchr($url, '.');

        $attribs['path'] = $url;
        $attribs['type'] = ltrim($ext, '.');

        parent::__construct("Play", $attribs);
    }

    public function setUrl($url)
    {
        return $this->setAttribute('path', $url);
    }

    public function setType($type = 'wave')
    {
        $supported = ['wave', 'gsm', 'mp3'];
        $type = in_array($type, $supported) ? $type : 'wave';

        return $this->setAttribute('type', $type);
    }

    public function setDuration($duration = 30)
    {
        return $this->setAttribute('duration', $duration);
    }

    public function getDefaultAttributes()
    {
        return [
            'type' => 'wave'
        ];
    }
}
