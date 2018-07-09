<?php

namespace Mobtexting\Voice\Tag;

use Mobtexting\Voice\Voice;

class Saynumber extends Voice
{
    public function __construct($number = null)
    {
        parent::__construct("SayPin", ['number' => $number]);
    }

    public function SetGender($gender)
    {
        $gender = \in_array(['m', 'f'], $gender) ? $gender : 'm';
        return $this->setAttribute('gender', $gender);
    }

    public function getDefaultAttributes()
    {
        return [
            "gender" => "m"
        ];
    }
}
