<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Sms extends Voice
{
    public function __construct($to, $message = null)
    {
        if (\is_array($message)) {
            $attrib = $message;
            $attrib['to'] = $to;
        } else {
            $attrib = ['to' => $to, 'content' => $message];
        }
        parent::__construct("Sms", $attrib);
    }

    public function SetFrom($from)
    {
        $this->setAttribute('senderid', $from);
    }

    public function SetBody($content)
    {
        $this->setAttribute('content', $content);
    }

    public function SetApiKey($key)
    {
        $this->setAttribute('key', $key);
    }

    public function getDefaultAttributes()
    {
        return [
            "platform" => "voice",
            "type" => 'Simple'
        ];
    }
}
