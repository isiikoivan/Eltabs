<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

// Inject standard global HTML header metadata tags, links, and registered asset bundles safely
$this->render('_head');

// 1. EL-TABS ROUTING CONTEXT EXTRACTION
// Capture the current executing controller's unique string ID matching the runtime lifecycle state.
$currentControllerId = Yii::$app->controller->id;

// 2. REGISTRY INTERROGATION MATRIX
// Query the centralized registry hub using our controller ID as an index lookup key.
// If matching tab items exist, it returns a configuration array matrix; otherwise, an empty array fallback.
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

    <?php //= $this->render('_header') // Global application header navigation wrapper component fallback ?>

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
                            'items'        => $dynamicTabs
                        ]) ?>

                    </div>
                <?php endif; ?>

                <?= Alert::widget() ?>
                <?= $content // Streams rendered view templates safely (e.g., index.php, view.php, fees.php) ?>

            </div>
        </div>

    </main>

    <?php //= $this->render('_footer') // Global application footer copyright layer component fallback ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
