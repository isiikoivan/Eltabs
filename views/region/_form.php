<?php

use yii\helpers\Html;use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var \app\modules\biz\models\Region $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="region-form">

    <?php $form = ActiveForm::begin(); ?>


<div class="row">
    <div class="col-lg-6 col-md-4 col-sm-12">
        <?= $form->field($model, 'country_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(
                        \app\modules\biz\models\Country::find()->all(),
                        'id',
                        'description'
                ),
                ['prompt' => 'Select Country']
        )->label('Country') ?>
    </div>
    <div class="col-lg-6 col-md-4 col-sm-12"><?= $form->field($model, 'description')->textInput()->label('Region Name') ?></div>

</div>

<!--    --><?php //= $form->field($model, 'date_created')->textInput() ?>

<!--    --><?php //= $form->field($model, 'created_by')->textInput() ?>

<!--    --><?php //= $form->field($model, 'updated_on')->textInput() ?>

<!--    --><?php //= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
