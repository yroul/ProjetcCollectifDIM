<?php

namespace HGR\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HGRUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }
}
