<?php
$head = head(['title' => metadata('item', ['Dublin Core', 'Title']), 'bodyclass' => 'items show']);

$page_title = 'Items';

$item_title = metadata('item', ['Dublin Core', 'Title']);

$has_images = $item->Files;

$files_html = files_for_item(['imageSize' => 'fullsize']);

$omeka_db = get_db();
$exhibit_list = new \BCLib\ExhibitList($omeka_db);
$has_exhibits = $exhibit_list->hasExhibits($item);
$exhibits = $has_exhibits ? $exhibit_list->exhibits($item) : [];

?>

<?= $head; ?>

<?php include __DIR__ . '/../common/page-title.php'; ?>

<main id="content" class="container">
    <div class="row">
        <h2><?= $item_title; ?></h2>
    </div>

    <div class="row">
        <div class="col-md-8 col-sm-12 item-main">
            <div class="metadata-box-wrap">
                <div class="metadata-box">
                    <?php if ($has_images): ?>
                        <div class="item-file section row">
                            <div class="sub-section">
                                <?= $files_html ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="no-image">No photos available.</div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="metadata-box-wrap">
                <div class="metadata-box">
                    <?php echo all_element_texts('item'); ?>
                    <?php fire_plugin_hook('public_items_show', ['view' => $this, 'item' => $item]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 item-side">

            <?php if ($has_exhibits): ?>
                <div class="metadata-box-wrap">
                    <div class="metadata-box">
                        <div class="item section row">
                            <div id="exhibit" class="element sub-section">
                                <h3>Appears in Exhibits</h3>
                                <div class="element-text">
                                    <?php foreach ($exhibits as $exhibit): ?>
                                        <p>
                                            <a href="<?= WEB_ROOT ?>/exhibits/show/<?= $exhibit['slug']; ?>">
                                        <?= $exhibit['title']; ?></a>
                                        </p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="metadata-box-wrap">
                <div class="metadata-box">
                    <div id="item-citation" class="element">
                        <h3><?php echo __('Citation'); ?></h3>
                        <div class="element-text"><?php echo metadata(
                                'item',
                                'citation',
                                ['no_escape' => true]
                            ); ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div class="nav-prev"><?php echo link_to_previous_item_show(null, ['class'=>'previous-page']); ?></div>
        <div class="nav-next"><?php echo link_to_next_item_show(null, ['class'=>'next-page']); ?></div>

</main>

<?php echo foot(); ?>
