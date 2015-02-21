<?php

namespace GFire\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GFireUserBundle extends Bundle
{
    public function getParent()
    {

        return 'FOSUserBundle';
    }
}
