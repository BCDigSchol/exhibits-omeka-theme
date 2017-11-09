<?php
$title = __('Exhibits');

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

$result_count_display = __('(%s total)', $total_results);

$featured_exhibits = get_records('Exhibit', ['tags' => 'featured'], 2);
$upcoming_exhibits = get_records('Exhibit', ['tags' => 'upcoming'], 2);
?>
<?= $head ?>
    <div class="sub-header">
        <div class="container">
            <h2><?= $title; ?> <?= $result_count_display; ?></h2>
        </div>
    </div>
<?php if (count($exhibits) > 0): ?>
    <div class="container">

    <nav class="navigation secondary-nav">
        <?= $secondary_nav ?>
    </nav>

    <?= pagination_links(); ?>

    <div class="row no-gutters noteworthy-exhibits">
        <div class="col-sm-12 col-md-6 featured-exhibits">
            <h2 class="section-title">Featured</h2>
            <div class="section current-exhibits">
                <?php if ($featured_exhibits): ?>
                    <?= \BC\Helpers\noteworthy_exhibit_box($featured_exhibits) ?>
                <?php else: ?>
                    <div class="sub-section">There are no current exhibits at this time</div>
                <?php endif ?>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 featured-exhibits">
            <h2 class="section-title">Upcoming</h2>
            <div class="section current-exhibits">
                <?php if ($upcoming_exhibits): ?>
                    <?= \BC\Helpers\noteworthy_exhibit_box($upcoming_exhibits) ?>
                <?php else: ?>
                    <div class="sub-section">There are no upcoming exhibits planned at this time</div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <?php foreach (loop('exhibit') as $exhibit): ?>
        <div class="exhibit row">
            <div class="col-md-12">
                <h2><?= link_to_exhibit(); ?></h2>
                <?= BC\Helpers\linked_exhibit_thumb($exhibit); ?>
                <?= BC\Helpers\exhibit_description(); ?>
                <?= BC\Helpers\exhibit_tags(); ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?= pagination_links(); ?>

<?php else: ?>
    <p><?= __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>
    </div>
<?= foot(); ?>