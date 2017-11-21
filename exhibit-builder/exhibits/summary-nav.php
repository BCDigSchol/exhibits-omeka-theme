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