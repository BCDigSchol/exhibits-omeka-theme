<?php

namespace BCLib;

require_once __DIR__ . '/NavMenuPage.php';

class NavMenu
{
    /**
     * @var \Omeka_Navigation
     */
    private $omeka_nav;

    public function __construct(\Omeka_Navigation $omeka_nav)
    {
        $this->omeka_nav = $omeka_nav;
    }

    /**
     * Get menu pages
     *
     * @return \Generator
     */
    public function pages()
    {
        foreach ($this->omeka_nav as $omeka_nav_page) {
            if ($omeka_nav_page->isVisible()) {
                yield new NavMenuPage($omeka_nav_page);
            }
        }
    }
}