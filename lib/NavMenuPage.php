<?php

namespace BCLib;

class NavMenuPage
{
    /**
     * @var \Omeka_Navigation_Page_Uri
     */
    private $omeka_page;

    public $active_status;
    public $has_submenu;
    public $label;
    public $href;
    public $class;

    public function __construct(\Zend_Navigation_Page $omeka_page)
    {
        $this->omeka_page = $omeka_page;
        $this->active_status = $omeka_page->isActive() ? 'active' : '';
        $this->href = $omeka_page->getHref();
        $this->label = $omeka_page->getLabel();
        $this->has_submenu = $omeka_page->hasPages();
        $this->class = $this->slugify($this->label);
    }

    /**
     * Get pages of submenu
     *
     * @return \Generator
     */
    public function pages()
    {
        foreach ($this->omeka_page->getPages() as $omeka_nav_page) {
            if ($omeka_nav_page->isVisible()) {
                yield new NavMenuPage($omeka_nav_page);
            }
        }
    }

    private function slugify($str)
    {
        $ascii_encoded = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $no_non_alphanumeric = preg_replace('/[^A-Za-z0-9]+/', '-', $ascii_encoded);
        return strtolower(trim($no_non_alphanumeric));
    }
}