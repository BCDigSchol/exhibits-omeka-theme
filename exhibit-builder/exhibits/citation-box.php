<?php
$place = metadata('exhibit', 'physical_place');
$dates = metadata('exhibit', 'physical_date_range');
?>
<?php if ($place): ?>
    <div class="metadata-box-wrap">
        <div class="metadata-box">
            <h3>Citation</h3>
            <cite><?= $exhibit_title; ?></cite>. <?= $dates; ?>, <?= $place; ?>, Chestnut Hill.
        </div>
    </div>
<?php endif; ?>