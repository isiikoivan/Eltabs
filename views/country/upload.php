<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Upload Countries';

?>

<div class="card">

    <div class="card-header">
        <h4>Upload Excel</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>

        <div class="form-group">

            <label>Select Excel File</label>

            <input type="file"
                   name="upload_file"
                   class="form-control">

        </div>

        <br>

        <?= Html::submitButton('Upload', [
            'class' => 'btn btn-success'
        ]) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
