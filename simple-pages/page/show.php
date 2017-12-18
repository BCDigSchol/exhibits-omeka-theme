<?php
$bodyclass = 'page simple-page';

echo head(
    [
        'title'     => metadata('simple_pages_page', 'title'),
        'bodyclass' => $bodyclass,
        'bodyid'    => metadata('simple_pages_page', 'slug')
    ]
);

$page_title = metadata('simple_pages_page', 'title');
$page_text = metadata('simple_pages_page', 'text', ['no_escape' => true]);

?>
<?php include __DIR__ . '/../../common/page-title.php' ?>
<div id="primary">
    <main id="content">
        <div class="special-page-content">
            <h1><?= $page_title; ?></h1>
            <?= $this->shortcodes($page_text); ?>
        </div>
    </main>
</div>

<?php echo foot(); ?>
