<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var array $items The processed tab menu configuration items array matrix passed from the Widget context.
 */
?>

<ul class="sub-menu-location-tabs">
    <?php foreach ($items as $id => $item): ?>
        <?php
        // Pure backward-compatible array parsing (Works seamlessly from PHP 5.6 to 8.x+)
        $isActive = (isset($item['active']) && $item['active'] === true);
        $cssClass = $isActive ? 'clink_location active' : 'clink_location';

        $label = isset($item['label']) ? $item['label'] : '';
        $url   = isset($item['url']) ? $item['url'] : '#';
        ?>

        <li class="<?= Html::encode($cssClass) ?>" id="tab-<?= Html::encode($id) ?>">
            <?= Html::a(Html::encode($label), Url::to($url)) ?>
        </li>
    <?php endforeach; ?>
</ul>
