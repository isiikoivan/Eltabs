<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\modules\biz\models\RegionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-search">

    <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['data-pjax' => 0],
    ]); ?>
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <?= $form->field($model, 'country_id')->dropDownList(
                    \yii\helpers\ArrayHelper::map(
                            \app\modules\biz\models\Country::find()->all(),
                            'id',
                            'description'
                    ),
                    ['prompt' => 'Select Country']
            )->label(false) ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <?= $form->field($model, 'description')->textInput(['placeholder' => 'Region'])->label(false) ?>
        </div>

        <!--    --><?php //= $form->field($model, 'id') ?>


        <!--    --><?php //= $form->field($model, 'country_id') ?>

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
