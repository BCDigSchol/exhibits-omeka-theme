<?php

namespace BC\Helpers;

const TAG_FEATURED = 'featured';
const TAG_UPCOMING = 'upcoming';

function linked_exhibit_thumb($exhibit)
{
    $image = record_image($exhibit, 'thumbnail');
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

    $img = linked_exhibit_thumb($exhibit);
    $description = substr(strip_tags($exhibit->description), 0, 200);

    return <<<EXHIBIT
        <div class="sub-section exhibit">
            <h3 class="sub-section-title">$link</h3>
            $img
            <div class="description small-12 medium-8 large-8 columns">$description</div>
        </div>
EXHIBIT;
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