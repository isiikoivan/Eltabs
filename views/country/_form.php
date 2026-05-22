<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Country';

?>

<div class="card">
    <div class="card-header">
        <h4>Create Country</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label>Country Name</label>

            <input type="text"
                   name="description"
                   class="form-control"
                   placeholder="Enter country name">
        </div>

        <br>

        <div class="form-group">
            <?= Html::submitButton('Save', [
                'class' => 'btn btn-success'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
