<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Email extends Voice
{
    public function __construct($to, $message = null)
    {
        if (\is_array($message)) {
            $attrib = $message;
            $attrib['to'] = $to;
        } else {
            $attrib = ['to' => $to, 'message' => $message];
        }
        parent::__construct("Email", $attrib);
    }

    public function getDefaultAttributes()
    {
        return [
            "cc" => "",
            "bcc" => '',
            "attachments" => ""
        ];
    }
}
