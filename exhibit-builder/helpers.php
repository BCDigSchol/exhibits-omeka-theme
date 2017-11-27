<?php

namespace BC\Helpers;

const TAG_FEATURED = 'featured';
const TAG_UPCOMING = 'upcoming';

function linked_exhibit_cover($exhibit, $size = 'thumbnail')
{
    $image = record_image($exhibit, $size);
    return $image ? exhibit_builder_link_to_exhibit($exhibit, $image, ['class' => 'image']) : '';
}

function exhibit_description()
{
    $description = metadata('exhibit', 'description', ['no_escape' => true]);
    return $description ? "<div class=\"description\">$description</div>" : '';
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
            <div class="description col-md-8 columns">{$description}…</div>
        </div>
EXHIBIT;
}

function truncated_description($exhibit, $length = 200)
{
    return substr(strip_tags($exhibit->description), 0, $length);
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

function citation_date($start_date, $end_date)
{
}