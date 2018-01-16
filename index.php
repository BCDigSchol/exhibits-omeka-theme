<?php

$exhibit_list = new \BCLib\ExhibitList(get_db());
$exhibits = $exhibit_list->topExhibits();

?>

<?php echo head(['bodyid' => 'home']); ?>

<main id="content" class="container">
    <div class="row">

        <?php if (isset($exhibits[0])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[0]); ?>
        <?php endif; ?>

        <?php if (isset($exhibits[1])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[1], false, 2); ?>
        <?php endif; ?>

        <?php if (isset($exhibits[2])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[2], false, 3); ?>
        <?php endif; ?>
    </div>
</main>

<?php echo foot(); ?>
