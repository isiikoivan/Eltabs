<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Region';

?>

<div class="card">

    <div class="card-header">
        <h4>Create Region</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">

            <label>Region Name</label>

            <input type="text"
                   name="description"
                   class="form-control"
                   placeholder="Enter region name">

        </div>

        <br>

        <div class="form-group">

            <label>Country</label>

            <select class="form-control" name="country_id">

                <option value="">Select Country</option>
                <option value="1">Uganda</option>
                <option value="2">Kenya</option>

            </select>

        </div>

        <br>

        <?= Html::submitButton('Save', [
            'class' => 'btn btn-success'
        ]) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
