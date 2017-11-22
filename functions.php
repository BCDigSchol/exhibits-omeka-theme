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

function front_page_exhibits() {
    return [
        1 => front_page_exhibit(1),
        2 => front_page_exhibit(2),
        3 => front_page_exhibit(3)
    ];
}

function front_page_exhibit($number) {
    $exhibit = new \stdClass();
    $exhibit->img = get_theme_option("Slider File $number");
    $exhibit->text = get_theme_option("File $number Textarea");
    return $exhibit;
}