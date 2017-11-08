<?php
    $collectionTitle = strip_formatting(metadata('collection', ['Dublin Core', 'Title']));
    echo head(['title' => $collectionTitle, 'bodyclass' => 'collections show']);
?>
    <h1><?php echo $collectionTitle; ?></h1>
    <?php echo all_element_texts('collection'); ?>

    <div id="collection-items">
        <h2><?php echo link_to_items_browse(__('Items in the %s Collection', $collectionTitle), ['collection' => metadata('collection', 'id')]
            ); ?></h2>
        <?php if (metadata('collection', 'total_items') > 0): ?>
            <?php foreach (loop('items') as $item): ?>
            <?php $itemTitle = strip_formatting(metadata('item', ['Dublin Core', 'Title'])); ?>
            <div class="item hentry">
                <h3><?php echo link_to_item($itemTitle, ['class' =>'permalink']); ?></h3>
    
                <?php if (metadata('item', 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('square_thumbnail', ['alt' => $itemTitle])); ?>
                </div>
                <?php endif; ?>
    
                <?php if ($text = metadata('item', ['Item Type Metadata', 'Text'], ['snippet' =>250])): ?>
                <div class="item-description">
                    <p><?php echo $text; ?></p>
                </div>
                <?php elseif ($description = metadata('item', ['Dublin Core', 'Description'], ['snippet' =>250])): ?>
                <div class="item-description">
                    <?php echo $description; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p><?php echo __('There are currently no items within this collection.'); ?></p>
        <?php endif; ?>
    </div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', ['view' => $this, 'collection' => $collection]); ?>
<?php echo foot(); ?>
