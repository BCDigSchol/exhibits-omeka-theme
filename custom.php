<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/exhibit-builder/helpers.php';

/**
 * Return the markup for the exhibit page navigation.
 *
 * @param ExhibitPage|null $exhibitPage If null, uses the current exhibit page
 * @return string
 *
 * Modified function from 'helpers/ExhibitPageFunctions.php' file so the 'Jump to...'
 * menu would display the menu tree correctly
 */
function custom_exhibit_builder_page_nav($exhibitPage = null)
{
    if (!$exhibitPage) {
        if (!($exhibitPage = get_current_record('exhibit_page', false))) {
            return;
        }
    }

    $exhibit = $exhibitPage->getExhibit();
    $html = '<ul class="exhibit-page-nav navigation" id="secondary-nav">' . "\n";
    $pagesTrail = $exhibitPage->getAncestors();
    $pagesTrail[] = $exhibitPage;
    $html .= '<li>';
    $html .= '<a class="exhibit-title" href="'. html_escape(exhibit_builder_exhibit_uri($exhibit)) . '">';
    $html .= html_escape($exhibit->title) .'</a></li>' . "\n";
    $page = $pagesTrail[0];
    $linkText = $page->title;
    $pageExhibit = $page->getExhibit();
    $pageParent = $page->getParent();
    $pageSiblings = ($pageParent ? exhibit_builder_child_pages($pageParent) : $pageExhibit->getTopPages());

    $html .= "<li>\n<ul>\n";
    foreach ($pageSiblings as $pageSibling) {
        $html .= '<li' . ($pageSibling->id == $page->id ? ' class="current"' : '') . '>';
        $html .= '<a class="exhibit-page-title" href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $pageSibling)) . '">';
        $html .= html_escape($pageSibling->title) . "</a></li>\n";
        $children = exhibit_builder_child_pages($pageSibling);
        if ($children) {
            $html .= custom_exhibit_builder_child_page_nav($pageSibling);
        }
    }
    $html .= "</ul>\n</li>\n";

    $html .= '</ul>' . "\n";
    $html = apply_filters('exhibit_builder_page_nav', $html);
    return $html;
}


/**
 * Return the markup for the exhibit child page navigation.
 *
 * @param ExhibitPage|null $exhibitPage If null, uses the current exhibit page
 * @return string
 *
 * Modified function from 'helpers/ExhibitPageFunctions.php' file so the 'Jump to...'
 * menu would display the menu tree correctly
 */
function custom_exhibit_builder_child_page_nav($exhibitPage = null)
{
    if (!$exhibitPage) {
        $exhibitPage = get_current_record('exhibit_page');
    }

    $currentPage = get_current_record('exhibit_page');

    $exhibit = $exhibitPage->getExhibit();
    $children = exhibit_builder_child_pages($exhibitPage);
    $html = '<ul class="exhibit-child-nav navigation">' . "\n";
    foreach ($children as $child) {

        $html .= '<li' . ($child->id == $currentPage->id ? ' class="current"' : '') . '><a href="' . html_escape(exhibit_builder_exhibit_uri($exhibit, $child)) . '">' . html_escape($child->title) . '</a></li>';
        $children = exhibit_builder_child_pages($child);
        if ($children) {
            $html .= exhibit_builder_child_page_nav($child);
        }
    }
    $html .= '</ul>' . "\n";
    return $html;
}