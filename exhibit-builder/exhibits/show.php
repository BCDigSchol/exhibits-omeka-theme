<?php
echo head(
    [
        'title'     => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
        'bodyclass' => 'exhibits show'
    ]
);
?>

<h1><span class="exhibit-page"><?= metadata('exhibit_page', 'title'); ?></span></h1>

<div id="exhibit-blocks">
    <?php exhibit_builder_render_exhibit_page(); ?>
</div>

<div id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
        <div id="exhibit-nav-prev">
            <?= $prevLink; ?>
        </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
        <div id="exhibit-nav-next">
            <?= $nextLink; ?>
        </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
        <?= exhibit_builder_page_trail(); ?>
    </div>
</div>

<nav id="exhibit-pages">
    <h4><?= exhibit_builder_link_to_exhibit($exhibit); ?></h4>
    <?= exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
</nav>
<?= foot(); ?>
