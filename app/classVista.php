<?php

use Jenssegers\Blade\Blade;

class Vista
{
  public static function render($page, $data = [])
  {
    $blade = new Blade('app/views', 'cache');
    echo $blade->render($page, $data);
  }
}
