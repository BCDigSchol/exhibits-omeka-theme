<?php

require_once __DIR__ . '/../helpers.php';

$head = head(['title' => metadata('exhibit', 'title'), 'bodyclass' => 'exhibits summary']);

$title = metadata('exhibit', 'title');

$description = metadata('exhibit', 'description', ['no_escape' => true]);

$credits = metadata('exhibit', 'credits');

$topPages = $exhibit->getTopPages();

$exhibit_uri = exhibit_builder_exhibit_uri($exhibit, $topPages[0]);

?>
<?= $head; ?>

<div class="sub-header">
    <div class="container">
        <h1>Exhibits</h1>
    </div>
</div>

<div class="container summary">
    <h2><?= $title; ?></h2>

    <?= exhibit_builder_page_nav(); ?>

    <div id="primary" class="col-md-8">
        <div class="exhibit-description">
            <?= \BC\Helpers\linked_exhibit_cover($exhibit); ?>

            <?= $description; ?>
        </div>

        <div class="exhibit-credits">
            <h3><?= __('Credits'); ?></h3>
            <p><?= $credits; ?></p>
        </div>
    </div>
    <div class=" col-md-4">

    <span class="enter-exhibit"><a href="<?= $exhibit_uri; ?>">view exhibit</a></span>

    <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <nav id="exhibit-pages" class="section exhibit-nav">
            <h3 class="sub-section-title"><?= __('Jump to...'); ?></h3>
            <ul>
                <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                    <?php echo exhibit_builder_page_summary($exhibitPage); ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>
<?= foot(); ?>
