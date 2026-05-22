<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\modules\biz\models\District $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="district-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
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
        <div class="col-lg-6 col-md-4 col-sm-12">
            <label class="form-label">Upload Region File</label>
            <div class="custom-file-input-wrapper">
                <?= $form->field($model, 'upload_file')->fileInput([
                        'class' => 'form-control',
                ])->label(false) ?>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
