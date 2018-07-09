<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Conference extends Voice
{
    public function __construct($numbers = null, $attribs = [])
    {
        $numbers = !is_array($numbers) ? explode(',', $numbers) : $numbers;

        $attribs['numbers'] = $numbers;
        parent::__construct("Conference", $attribs);
    }

    public function setJoinPrompt($message)
    {
        return $this->setAttribute('join_prompt', $message);
    }

    public function setAdminNumber($number)
    {
        return $this->setAttribute('admin_number', $number);
    }

    public function setLeavePrompt($message)
    {
        return $this->setAttribute('leave_prompt', $message);
    }

    public function setIsSystemDial($is)
    {
        return $this->setAttribute('is_system_dial', $is);
    }

    public function getDefaultAttributes()
    {
        return [
            'is_system_dial' => false,
            'retry_times' => 0,
            'minutes' => 0,
            'schedule_time' => "",
            'admin' => "",
            'join_prompt' => "",
            'leave_prompt' => "",
            'admin_number' => "",
            'pin' => "",
            'name' => "",
        ];
    }
}
