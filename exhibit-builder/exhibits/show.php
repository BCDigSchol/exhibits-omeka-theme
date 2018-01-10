<?php
echo head(
    [
        'title'     => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
        'bodyclass' => 'exhibits show'
    ]
);

$page_title = 'Exhibits';

$previous_page_link = exhibit_builder_link_to_previous_page();
$next_page_link = exhibit_builder_link_to_next_page();

?>
<?php include __DIR__.'/../../common/page-title.php'; ?>
<div class="container">
    <div class="row exhibit-nav-row">
        <h2 class="col-sm-8"><span class="exhibit-page"><?= metadata('exhibit_page', 'title'); ?></span></h2>
        <div class="arrows col-sm-3 col-sm-offset-1">
            <?= $previous_page_link ?>
            <?= $next_page_link ?>
            <?php include __DIR__ . '/exhibit-nav.php'; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" id="exhibit-blocks">
            <div id="exhibit-blocks-wrap">
                <?php exhibit_builder_render_exhibit_page(); ?>

                <div id="exhibit-page-navigation">
                    <?php if ($previous_page_link): ?>
                        <div id="exhibit-nav-prev">
                            <?= $previous_page_link; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($next_page_link): ?>
                        <div id="exhibit-nav-next">
                            <?= $next_page_link; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>
<?= foot(); ?>
