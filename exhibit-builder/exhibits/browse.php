<?php

$title = __('All exhibits');

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

$exhibits_loop = loop('exhibit');
?>
<?= $head ?>

<?php include __DIR__ . '/../../common/page-title.php'; ?>
    <main id="content" class="container">
        <?php if (count($exhibits) > 0): ?>

            <nav class="navigation secondary-nav">
                <ul>
                    <?= $secondary_nav ?>
                </ul>
            </nav>

            <?= pagination_links(); ?>

            <h2>Boston College Libraries Exhibits</h2>
            <div class="full-exhibit-list">
                <?php foreach ($exhibits_loop as $exhibit): ?>
                    <div class="<?= \BC\Helpers\exhibit_classes($exhibit); ?>">
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
    </main>
<?= foot(); ?>