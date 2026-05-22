<?php

use yii\helpers\Url;

?>

<ul class="sub-menu-location-tabs">
    <li class="clink_location  <?= Yii::$app->controller->id == 'country' ? 'active' : '' ?>" id="country">
        <a href="<?= Url::to(['country/index']) ?>">Country</a>
    </li>
    <li class="clink_location <?= Yii::$app->controller->id == 'region' ? 'active' : '' ?>" id="region">
        <a href="<?= Url::to(['region/index']) ?>">Region</a>
    </li>

</ul>

<?php
$css = <<<CSS

.sub-menu-location-tabs {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
    border-bottom: 2px solid #ddd;
    gap: 5px;
}

.sub-menu-location-tabs .clink_location {
    margin: 0;
}

.sub-menu-location-tabs .clink_location a {
    display: block;
    padding: 10px 18px;
    text-decoration: none;
    color: #555;
    background: #f5f5f5;
    border: 1px solid #ddd;
    border-bottom: none;
    border-radius: 6px 6px 0 0;
    transition: all 0.2s ease-in-out;
    font-size: 14px;
}

.sub-menu-location-tabs .clink_location a:hover {
    background: #e9ecef;
    color: #000;
}

.sub-menu-location-tabs .clink_location.active a {
    background: #ffffff;
    color: #000;
    font-weight: 600;
    border-bottom: 2px solid #ffffff;
    position: relative;
    top: 2px;
}

CSS;

$this->registerCss($css);
