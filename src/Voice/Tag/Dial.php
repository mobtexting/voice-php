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
        $newTag = $this->append($tag, $attribs);
        if($isSequential){
            $this->attributes['onanswer'] = array_merge($this->attributes['onanswer'], array($newTag) );
        }else {
            $this->setAttribute('onanswer', array($newTag), true);
        }
        return $newTag;
    }

    public function onNoAnswer($tag, $attribs = [], $isSequential = false)
    {
        $newTag = $this->append($tag, $attribs);
        if($isSequential){
            $this->attributes['onnoanswer'] = array_merge($this->attributes['onnoanswer'], array($newTag) );
        }else {
            $this->setAttribute('onnoanswer', array($newTag), true);
        }
        return $newTag;
    }

    public function noAnswer($tag, $attribs = [], $isSequential = false)
    {
        $newTag = $this->append($tag, $attribs);
        if($isSequential){
            $this->attributes['onnoanswer'] = array_merge($this->attributes['onnoanswer'], array($newTag) );
        }else {
            $this->setAttribute('onnoanswer', array($newTag), true);
        }
        return $newTag;
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
