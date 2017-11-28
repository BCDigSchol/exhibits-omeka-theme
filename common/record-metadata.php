<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
    <div class="element-set">

        <?php if ($showElementSetHeadings): ?>
            <h2><?= html_escape(__('Item information')); ?></h2>
        <?php endif; ?>

        <?php foreach ($setElements as $elementName => $elementInfo): ?>
            <div id="<?= text_to_id(html_escape("$setName $elementName")); ?>" class="element">
                <h3><?= html_escape(__($elementName)); ?></h3>

                <?php foreach ($elementInfo['texts'] as $text): ?>
                    <div class="element-text"><?= $text; ?></div>
                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>

    </div>
<?php endforeach;