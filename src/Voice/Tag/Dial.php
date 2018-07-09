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
        return $this->setAttribute('onanswer', $this->append($tag, $attribs), true);
    }

    public function onNoAnswer($tag, $attribs = [])
    {
        return $this->setAttribute('onnoanswer', $this->append($tag, $attribs), true);
    }

    public function noAnswer($tag, $attribs = [])
    {
        return $this->setAttribute('onnoanswer', $this->append($tag, $attribs), true);
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
