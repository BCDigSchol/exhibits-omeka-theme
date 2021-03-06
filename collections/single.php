<div class="collection record">
    <?php
        $title = metadata($collection, ['Dublin Core', 'Title']);
        $description = metadata($collection, ['Dublin Core', 'Description'], ['snippet' => 150]);
    ?>
    <h3><?php echo link_to($this->collection, 'show', strip_formatting($title)); ?></h3>
    
    <?php if ($collectionImage = record_image($collection, 'square_thumbnail')): ?>
        <?php echo link_to($this->collection, 'show', $collectionImage, ['class' => 'image']); ?>
    <?php endif; ?>
    <?php if ($description): ?>
        <p class="collection-description"><?php echo $description; ?></p>
    <?php endif; ?>
</div>
