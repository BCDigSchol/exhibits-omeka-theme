<?php
    $pageTitle = __('Browse collections');
    echo head(['title' =>$pageTitle, 'bodyclass' => 'collections browse']);
?>

    <h1><?php echo 'Browse all collections'; ?></h1>
    
    <div class="browse-collections">
        <?php if ($total_results > 0): ?>
            <div class="browse-collections-header hidden-xs">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-2">
                        <?php echo browse_sort_links(['Title' =>'Dublin Core,Title'], ['']); ?>
                    </div>
                    <div class="col-sm-3">
                        <?php echo browse_sort_links(['Creator' =>'Dublin Core,Contributor'], ['']); ?>
                    </div>
                    <div class="col-sm-4">
                        Description
                    </div>
                </div>
            </div>
        
            <?php foreach (loop('collections') as $collection): ?>
                <div class="collection">
                    <div class="row">
                        <div class="col-sm-2">
                            <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
                                <?php echo link_to_collection($collectionImage, ['class' => 'image']); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-3">
                            <?php echo link_to_collection(); ?>
                        </div>
                        <div class="col-sm-3">
                            <?php if ($collection->hasContributor()): ?>
                                <?php echo metadata('collection', ['Dublin Core', 'Contributor'], ['all' =>true, 'delimiter' =>', ']
                                ); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-4">
                            <?php if (metadata('collection', ['Dublin Core', 'Description'])): ?>
                                <?php echo text_to_paragraphs(metadata('collection', ['Dublin Core', 'Description'], ['snippet' =>150]
                                )); ?>
                            <?php endif; ?>
                        </div>
                    
                        <?php fire_plugin_hook('public_collections_browse_each', ['view' => $this, 'collection' => $collection]
                        ); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p><?php echo 'No collections added, yet.'; ?></p>
        <?php endif; ?>
    </div>
    <?php echo pagination_links(); ?>        

<?php fire_plugin_hook('public_collections_browse', ['collections' => $collections, 'view' => $this]); ?>
<?php echo foot(); ?>
