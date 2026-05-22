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
            <label class="form-label">Upload Country File</label>
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
