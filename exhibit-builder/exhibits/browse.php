<?php

$title = __('Exhibits');

$result_count_display = __('(%s total)', $total_results);

$page_title = "$title $result_count_display";

$head = head(['title' => $title, 'bodyclass' => 'exhibits browse']);

$secondary_nav = nav(
    [
        [
            'label' => __('Browse All'),
            'uri'   => url('exhibits')
        ],
        [
            'label' => __('Browse by Tag'),
            'uri'   => url('exhibits/tags')
        ]
    ]
);


$featured_exhibits = get_records('Exhibit', ['tags' => 'featured'], 2);
$upcoming_exhibits = get_records('Exhibit', ['tags' => 'upcoming'], 2);
?>
<?= $head ?>

<?php include __DIR__ . '/../../common/page-title.php'; ?>

<?php if (count($exhibits) > 0): ?>
    <div class="container">

    <nav class="navigation secondary-nav">
        <?= $secondary_nav ?>
    </nav>

    <?= pagination_links(); ?>

    <div class="row no-gutters noteworthy-exhibits">
        <div class="col-sm-12 col-md-6 featured-exhibits">
            <h2 class="section-title">Featured</h2>
            <div class="exhibit-list">
                <div class="section current-exhibits">
                    <?php if ($featured_exhibits): ?>
                        <?= \BC\Helpers\noteworthy_exhibit_box($featured_exhibits) ?>
                    <?php else: ?>
                        <div class="sub-section">There are no current exhibits at this time</div>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 featured-exhibits">
            <h2 class="section-title">Upcoming</h2>
            <div class="exhibit-list">
                <div class="section current-exhibits">
                    <?php if ($upcoming_exhibits): ?>
                        <?= \BC\Helpers\noteworthy_exhibit_box($upcoming_exhibits) ?>
                    <?php else: ?>
                        <div class="sub-section">There are no upcoming exhibits planned at this time</div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>


    <h2>Boston College Libraries Exhibits</h2>
    <div class="full-exhibit-list">
        <?php foreach (loop('exhibit') as $exhibit): ?>
            <div class="exhibit">
                <h3><?= link_to_exhibit(); ?></h3>
                <div class="col-md-2">
                    <?= BC\Helpers\linked_exhibit_cover($exhibit); ?>
                </div>
                <div class="col-md-10 description">
                    <?= \BC\Helpers\truncated_description($exhibit, 400, false); ?>
                    <?= BC\Helpers\exhibit_tags(); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?= pagination_links(); ?>

<?php else: ?>
    <p><?= __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>
    </div>
<?= foot(); ?>