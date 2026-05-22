<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Upload Regions';

?>

<div class="card">

    <div class="card-header">
        <h4>Upload Regions Excel</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>

        <div class="form-group">

            <label>Select Country</label>

            <select class="form-control" name="country_id">

                <option value="">Select Country</option>
                <option value="1">Uganda</option>
                <option value="2">Kenya</option>

            </select>

        </div>

        <br>

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
