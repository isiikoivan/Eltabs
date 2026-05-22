<?php

declare(strict_types=1);

/** @var yii\web\View $this */

/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

$this->render('_head');
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

<main id="main" class="flex-grow-1 container-fluid " role="main">

    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-3">
            <?= $this->render('sidebar') ?>
        </div>
        <div class="col-9 container">
            <div class="alert-info alert">
                <p>
                    <strong>Initial Implementations</strong>
                    (requires controller for each item, define all items in the location_menu_list including there controller and action,

                </p>
                <ul>
                    <li>
                      created a file  for tabs <strong>location_menu_list</strong> in layouts
                    </li>
                    <li>
                      created a file  for layout <strong>location_layout</strong> this to merge the tab into the new layout
                    </li>
                    <li>
                      created an action in the site controller or parent controller  , linked to the menu bar or sidebar for access  to the  tabbed view <strong>actionLocation </strong>in site
                    </li>

                </ul>
            </div>
            <?= Alert::widget() ?>
            <?= $this->render('location_menu_list.php') ?>
            <div class="p-2">
                <?= $content ?>
            </div>

        </div>
    </div>


</main>

<?php //= $this->render('_footer') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
