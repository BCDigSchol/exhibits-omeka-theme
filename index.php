<?php

$exhibit_list = new \BCLib\ExhibitList(get_db());
$exhibits = $exhibit_list->topExhibits();

?>

<?php echo head(['bodyid' => 'home']); ?>

<main id="content" class="container">
    <div class="row">
        <figure class="col-sm-12 main-exhibit">
            <?= \BC\Helpers\linked_exhibit_cover($exhibits[0], 'original') ?>
            <figcaption>
                <div class="exhibit-title"><?= $exhibits[0]->title; ?></div>
                <div class="exhibit-subtitle"><?= $exhibits[0]->subtitle; ?></div>
            </figcaption>
        </figure>

        <?php if (isset($exhibits[1])): ?>
            <figure class="col-sm-6 secondary-exhibit exhibit-two">
                <?= \BC\Helpers\linked_exhibit_cover($exhibits[1], 'original') ?>
                <figcaption>
                    <div class="exhibit-title"><?= $exhibits[1]->title; ?></div>
                    <div class="exhibit-subtitle"><?= $exhibits[1]->subtitle; ?></div>
                </figcaption>
            </figure>
        <?php endif; ?>

        <?php if (isset($exhibits[2])): ?>
            <figure class="col-sm-6 secondary-exhibit exhibit-three">
                <?= \BC\Helpers\linked_exhibit_cover($exhibits[2], 'original') ?>
                <figcaption>
                    <div class="exhibit-title"><?= $exhibits[2]->title; ?></div>
                    <div class="exhibit-subtitle"><?= $exhibits[2]->subtitle; ?></div>
                </figcaption>
            </figure>
        <?php endif; ?>
    </div>
</main>

<?php echo foot(); ?>
