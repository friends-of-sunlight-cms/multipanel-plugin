<?php

use Sunlight\Core;
use Sunlight\Extend;
use Sunlight\Hcm;
use Sunlight\Util\Form;

return function (bool $multiple = false, string $module = '') {
    Hcm::normalizeArgument($multiple, 'bool');
    Hcm::normalizeArgument($module, 'string');

    $config = Core::$pluginManager->getPlugins()->getExtend('multipanel')->getConfig();

    $items = [];
    $hideFirstMultiLabel = false;
    Extend::call('multipanel.' . (!empty($module) ? $module . '.' : '') . 'items', [
        'items' => &$items,
        'hide_first_multi_label' => &$hideFirstMultiLabel,
    ]);

    // skip rendering an empty multipanel items
    if (empty($items)) {
        return;
    }

    $roundedCorners = $config['rounded_corners'] ? ' rounded' : '';

    $output = _buffer(function () use ($config, $items, $multiple, $roundedCorners, $hideFirstMultiLabel) { ?>
        <section class="accordion<?= $roundedCorners ?>">
            <?php $i = 1;
            foreach ($items as $id => $item): ?>
                <div class="mptab mptab-<?= $id ?>">
                    <?= Form::input(($multiple ? 'checkbox' : 'radio'), 'accordion-' . Hcm::$uid, null, [
                            'id' => 'mp' . Hcm::$uid . 'tab' . $i,
                            'checked' => ($i === 1),
                    ])?>

                    <?php if ($multiple && $i == 1 && $hideFirstMultiLabel): ?>
                    <?php else: ?>
                        <label for="mp<?= Hcm::$uid ?>tab<?= $i ?>" class="mptab-label"><?= $item['label'] ?></label>
                    <?php endif; ?>

                    <div class="mptab-content">
                        <div class="mptab-content-inner"><?= $item['content'] ?></div>
                    </div>
                </div>
                <?php $i++; endforeach; ?>
        </section>
    <?php });

    return $output;
};
