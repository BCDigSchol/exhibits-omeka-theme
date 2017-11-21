<?php
echo head(
    [
        'title'     => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
        'bodyclass' => 'exhibits show'
    ]
);

$page_title = 'Exhibits';

?>
<?php include __DIR__ . '/page-title.php'; ?>
<div class="container">
    <div class="row">
        <div class="cold-md-12">
            <h1><span class="exhibit-page"><?= metadata('exhibit_page', 'title'); ?></span></h1>
            <input type="checkbox" id="exhibit-toggle" />
            <label for="exhibit-toggle" id="exhibitToggle" class="menu-button jump-to"  onclick="activate(this.id)">Jump to...
                <span class="exhibit-burger-icon"></span></label>
            <div class="exhibit-nav-wrap">
                <span>Jump to...</span>
                <nav id="exhibit-pages">
                    <?php echo custom_exhibit_builder_page_nav(); //Function found in custom.php file ?>
                </nav>
        </div>
        <div class="col-md-12">
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
        </div>
    </div>
</div>
<?= foot(); ?>
