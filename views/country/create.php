<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\modules\biz\models\Country $model */

$this->title = 'Create Country';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="country-create hd-title" data-title="Add Country">
    <div class="letter">
        <h4><i class="icon-plus"></i> <?= Html::encode($this->title) ?></h4>

        <?= $this->render('_form', [
                'model' => $model,
        ]) ?>

    </div>
</div>