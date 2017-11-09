<?php
namespace BC;

function public_nav_main_bootstrap() {
    $partial = ['common/menu-partial.phtml', 'default'];
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function even_odd($countable)
{
    return ($countable % 2 === 1) ? 'even' : 'odd';
}