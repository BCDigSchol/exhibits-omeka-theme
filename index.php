<?php

$exhibit_list = new \BCLib\ExhibitList(get_db());
$exhibits = $exhibit_list->topExhibits();

?>

<?php echo head(['bodyid' => 'home']); ?>

<main id="content" class="container">
    <div class="row" id="all-content">
        <div class="top-exhibit-block col-md-8">
            <?php if (isset($exhibits[0])): ?>
                <?= \BC\Helpers\home_page_exhibit_figure($exhibits[0]); ?>
            <?php endif; ?>
        </div>
        <div class="about-block col-md-4">
            <h2 id="home-title"><span class="bclib-name">Boston College Libraries</span> Digital Exhibits</h2>
            <div class="site-description">
                <p>Curated exhibits featuring items from the collections of the John J. Burns Library
                and other libraries at Boston College.</p>
            </div>
        </div>
    </div>
    <div class="row three-exhibit-row">
        <?php if (isset($exhibits[1])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[1], false, 2); ?>
        <?php endif; ?>

        <?php if (isset($exhibits[2])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[2], false, 2); ?>
        <?php endif; ?>

        <?php if (isset($exhibits[2])): ?>
            <?= \BC\Helpers\home_page_exhibit_figure($exhibits[2], false, 3); ?>
        <?php endif; ?>
    </div>
</main>

<?php echo foot(); ?>
