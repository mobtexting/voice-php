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

    public function onAnswer($tag, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onanswer'] = array_merge($this->attributes['onanswer'], array($this->append($tag, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onanswer', array($this->append($tag, $attribs)), true);
        }
    }

    public function onNoAnswer($tag, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onnoanswer'] = array_merge($this->attributes['onnoanswer'], array($this->append($tag, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onnoanswer', array($this->append($tag, $attribs)), true);
        }
    }

    public function noAnswer($tag, $attribs = [], $isSequential = false)
    {
        if($isSequential){
            $this->attributes['onnoanswer'] = array_merge($this->attributes['onnoanswer'], array($this->append($tag, $attribs)) );
            return $this->attributes;
        }else {
            return $this->setAttribute('onnoanswer', array($this->append($tag, $attribs)), true);
        }
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
