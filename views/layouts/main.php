<?php

declare(strict_types=1);

/** @var yii\web\View $this */

/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

$this->render('_head');
// Fetch the current active controller running the user's request
$currentControllerId = Yii::$app->controller->id;

// Automatically see if this controller has any tabs registered in Option A
$dynamicTabs = \app\components\EltabsMenuRegistry::getTabs($currentControllerId);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" data-bs-theme="light">
<head>
    <?php $this->head() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<?php //= $this->render('_header') ?>

<main id="main" class="flex-grow-1 " role="main">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <?php endif ?>
    <div class="row justify-content-center align-items-center vh-100" >
        <div class="col-3">
            <?= $this->render('sidebar') ?>
        </div>
        <div class="col-9 container">
            <?php if (!empty($dynamicTabs)): ?>
                <div class="dynamic-tabs-navigation-frame">
                    <?= \app\components\EltabsMenuWidget::widget([
                        'controllerId' => $currentControllerId,
                        'items' => $dynamicTabs
                    ]) ?>
                </div>
            <?php endif; ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>


</main>

<?php //= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
