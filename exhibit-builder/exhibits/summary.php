<?php

require_once __DIR__ . '/../helpers.php';

$head = head(['title' => metadata('exhibit', 'title'), 'bodyclass' => 'exhibits summary']);

$page_title = 'Exhibits';

$exhibit_title = metadata('exhibit', 'title');

$description = metadata('exhibit', 'description', ['no_escape' => true]);

$credits = metadata('exhibit', 'credits');

$topPages = $exhibit->getTopPages();

$exhibit_uri = exhibit_builder_exhibit_uri($exhibit, $topPages[0]);

?>
<?= $head; ?>

<?php include __DIR__ . '/../../common/page-title.php'; ?>

<div class="container summary">
    <h2 class="exhibit-title"><?= $exhibit_title; ?></h2>

    <?= exhibit_builder_page_nav(); ?>

    <div id="primary" class="col-md-8">
        <div class="exhibit-description">
            <?= \BC\Helpers\linked_exhibit_cover($exhibit, 'thumbnail', false); ?>

            <?= $description; ?>
        </div>

        <?php if ($credits): ?>
        <div class="exhibit-credits">
            <h3><?= __('Credits'); ?></h3>
            <p><?= $credits; ?></p>
        </div>
        <?php endif ?>

    </div>

    <?php include __DIR__ . '/summary-nav.php'; ?>
</div>
<?= foot(); ?>
