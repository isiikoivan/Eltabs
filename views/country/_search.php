<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\modules\biz\models\CountrySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="country-search">

    <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['data-pjax' => 0],
    ]); ?>

    <!--    --><?php //= $form->field($model, 'id') ?>
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?= $form->field($model, 'description')->textInput(['placeholder' => 'County'])->label(false) ?>
        </div>


        <!--    --><?php //= $form->field($model, 'logo_path') ?>

        <!--    --><?php //= $form->field($model, 'date_created') ?>

        <!--    --><?php //= $form->field($model, 'created_by') ?>

        <?php // echo $form->field($model, 'updated_on') ?>

        <?php // echo $form->field($model, 'updated_by') ?>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <!--        --><?php //= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
