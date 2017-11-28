<?php

$exhibits = \BC\front_page_exhibits();
?>

<?php echo head(['bodyid' => 'home']); ?>

<main id="content" class="container">
    <div class="row">
        <figure class="col-sm-12 main-exhibit">
            <img src="/files/theme_uploads/<?= $exhibits[1]->img; ?>" alt=""/>
            <figcaption>
                <div class="exhibit-title"><?= $exhibits[1]->text; ?></div>
                <div class="exhibit-subtitle">Lorem ipsum and more text</div>
            </figcaption>
        </figure>
        <figure class="col-sm-6 secondary-exhibit exhibit-two">
            <img src="/files/theme_uploads/<?= $exhibits[2]->img; ?>" alt=""/>
            <figcaption>
                <div class="exhibit-title"><?= $exhibits[2]->text; ?></div>
                <div class="exhibit-subtitle">Lorem ipsum and more text</div>
            </figcaption>
        </figure>
        <figure class="col-sm-6 secondary-exhibit exhibit-three">
            <img src="/files/theme_uploads/<?= $exhibits[3]->img; ?>" alt=""/>
            <figcaption>
                <div class="exhibit-title"><?= $exhibits[3]->text; ?></div>
                <div class="exhibit-subtitle">Lorem ipsum and more text</div>
            </figcaption>
        </figure>
    </div>
</main>

<?php echo foot(); ?>
