<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/exhibit-builder/helpers.php';
require_once __DIR__ . '/lib/ExhibitList.php';
require_once __DIR__ . '/lib/NavMenu.php';

/**
 * Return the markup for the exhibit page navigation.
 *
 *
 * Modified function from 'helpers/ExhibitPageFunctions.php' file so the 'Jump to...'
 * menu would display the menu tree correctly
 * @param ExhibitPage|null $exhibitPage If null, uses the current exhibit page
 * @return string
 * @throws Omeka_View
 */
function custom_exhibit_builder_page_nav(ExhibitPage $exhibitPage = null)
{
    $exhibitPage = $exhibitPage ? $exhibitPage : get_current_record('exhibit_page', false);
    if (!$exhibitPage) {
        return;
    }

    $exhibit = $exhibitPage->getExhibit();
    $pagesTrail = $exhibitPage->getAncestors();
    $pagesTrail[] = $exhibitPage;
    $page = $pagesTrail[0];
    $pageExhibit = $page->getExhibit();
    $pageParent = $page->getParent();
    $pageSiblings = ($pageParent ? exhibit_builder_child_pages($pageParent) : $pageExhibit->getTopPages());

    $exhibit_uri = html_escape(exhibit_builder_exhibit_uri($exhibit));
    $exhibit_title = html_escape($exhibit->title);

    $child_links = '';
    foreach ($pageSiblings as $pageSibling) {
        $child_links .= custom_exhibit_builder_page_link($pageSibling, $page, $exhibit);
    }

    $html = <<<HTML
<ul class="exhibit-page-nav navigation" id="secondary-nav">
    <li>
        <a class="exhibit-title" href="$exhibit_uri">$exhibit_title</a>
        </li>
        $child_links
</ul>
HTML;

    $html = apply_filters('exhibit_builder_page_nav', $html);
    return $html;
}

function custom_exhibit_builder_page_link($pageSibling, $page, $exhibit)
{
    $li_class = $pageSibling->id === $page->id ? ' class="current"' : '';
    $exhibit_uri = html_escape(exhibit_builder_exhibit_uri($exhibit, $pageSibling));
    $exhibit_title = html_escape($pageSibling->title);

    $html = <<<HTML
<li $li_class>
<a class="exhibit-page-title" href="$exhibit_uri">$exhibit_title</a>
</li>
HTML;

    $children = exhibit_builder_child_pages($pageSibling);
    if ($children) {
        $html .= custom_exhibit_builder_child_page_nav($pageSibling);
    }
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

        $html .= '<li' . ($child->id == $currentPage->id ? ' class="current"' : '') . '><a href="' . html_escape(
                exhibit_builder_exhibit_uri($exhibit, $child)
            ) . '">' . html_escape($child->title) . '</a></li>';
        $children = exhibit_builder_child_pages($child);
        if ($children) {
            $html .= exhibit_builder_child_page_nav($child);
        }
    }
    $html .= '</ul>' . "\n";
    return $html;
}