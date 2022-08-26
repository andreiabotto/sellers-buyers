<?php

namespace App\Managers\Interfaces;

interface ISenderManager
{
    public function SendMessage($address, $message) : bool;
}
