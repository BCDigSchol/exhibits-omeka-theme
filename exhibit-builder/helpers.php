<?php

namespace BC\Helpers;

use Exhibit;
const TAG_FEATURED = 'featured';
const TAG_UPCOMING = 'upcoming';

function home_page_exhibit_figure($exhibit, $large = true, $position = 1)
{
    $col_width = $large ? 'col-sm-12' : 'col-sm-6';
    $img = record_image($exhibit, 'original', ['alt' => '']);
    $text = <<<HTML
<figure class="$col_width exhibit-$position">
    $img
    <figcaption>
        <div class="exhibit-title">{$exhibit->title}</div>
        <div class="exhibit-subtitle">{$exhibit->title}</div>
    </figcaption>
</figure>
HTML;
    return exhibit_builder_link_to_exhibit($exhibit, $text);
}

function linked_exhibit_cover($exhibit, $size = 'thumbnail')
{
    if (!$exhibit) {
        return '';
    }
    $image = record_image($exhibit, $size, ['alt' => $exhibit->title]);
    return $image ? exhibit_builder_link_to_exhibit($exhibit, $image, ['class' => 'image']) : '';
}

function exhibit_description()
{
    $description = metadata('exhibit', 'description', ['no_escape' => true]);
    return $description ? "<div class=\"description\">$description</div>" : '';
}

function exhibit_classes(Exhibit $exhibit)
{
    $classes = ['exhibit'];
    if ($exhibit->featured) {
        $classes[] = 'featured';
    }
    return implode(' ', $classes);
}

function exhibit_tags()
{
    $tags = tag_string('exhibit', 'exhibits');
    return $tags ? "<p class=\"tags\">$tags</p>" : '';
}

function noteworthy_exhibit_box($exhibits)
{
    $return_val = '';
    foreach ($exhibits as $exhibit) {
        $return_val .= exhibit_brief_result($exhibit);
    }
    return $return_val;
}

function exhibit_brief_result($exhibit)
{
    $link = link_to_exhibit(null, [], null, $exhibit);

    $img = linked_exhibit_cover($exhibit);
    $description = truncated_description($exhibit);

    return <<<EXHIBIT
        <div class="sub-section exhibit">
            <h3 class="sub-section-title">$link</h3>
            <div class="col-md-4">$img</div>
            <div class="description col-md-8 columns">{$description}</div>
        </div>
EXHIBIT;
}

function truncated_description($exhibit, $length = 200, $brief = true)
{
    $description = $brief ? $exhibit->brief_description : $exhibit->description;
    $description = strip_tags($description);
    $truncated = substr($description, 0, $length + 1);
    return $truncated === $description ? $description : preg_replace('/\W+?(\w+)?$/u', '…', $truncated);
}

function img_from_description($description)
{
    $dom = new \DOMDocument();
    $dom->validateOnParse = true;
    $dom->loadHTML($description);

    $img = $dom->getElementsByTagName('img')->item(0);
    if ($img) {
        $img_link = $dom->saveXML($img);
        return "<div class=\"mainImage small-12 medium-4 large-4 columns\">$img_link</div>";
    }
    return '';
}

function page_tree()
{
    $tree = exhibit_builder_page_tree();
    $tree_html = "<nav id=\"exhibit-pages\" class=\"col-md-3\">$tree</nav>";
    return $tree ? $tree_html : '';
}