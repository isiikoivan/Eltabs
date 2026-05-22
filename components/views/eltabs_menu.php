<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="sub-menu-location-tabs">
    <?php foreach ($items as $id => $item): ?>
        <li class="clink_location <?= $item['active'] ? 'active' : '' ?>" id="<?= Html::encode($id) ?>">
            <?= Html::a(Html::encode($item['label']), Url::to($item['url'])) ?>
        </li>
    <?php endforeach; ?>
</ul>

