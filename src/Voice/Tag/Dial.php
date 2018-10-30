<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Dial extends Voice
{
    public function __construct($to, $from = null)
    {
        if (\is_array($from)) {
            $attrib = $from;
            $attrib['to'] = $to;
        } else {
            $attrib = ['to' => $to, 'callerid' => $from];
        }
        parent::__construct("Dial", $attrib);
    }

    public function onAnswer($tag, $attribs = [])
    {
        $new_tag = $this->append($tag, $attribs);
        $this->setAttribute('onanswer', array($new_tag), false);
        return $new_tag;
    }

    public function onNoAnswer($tag, $attribs = [])
    {
        $new_tag = $this->append($tag, $attribs);
        $this->setAttribute('onnoanswer', array($new_tag), false);
        return $new_tag;
    }

    public function getDefaultAttributes()
    {
        return [
            "musiconhold" => "",
            "agentwelcome" => '',
            "timeout" => 30,
            "stickyagent" => false,
            "smartagent" => false,
            "retries" => 2,
        ];
    }
}
