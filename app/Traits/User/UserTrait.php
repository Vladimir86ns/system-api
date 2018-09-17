<?php

namespace App\Traits\User;

use Sentinel;
use App\User;

trait UserTrait
{
    public function getUser()
    {
        return User::find(Sentinel::getUser()->id);
    }

    public function getCompany()
    {
        return $this->getUser()->company;
    }
}
