<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Country';

?>

<div class="card">
    <div class="card-header">
        <h4>Update Country</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">

            <label>Country Name</label>

            <input type="text"
                   name="description"
                   value="<?= $model['description'] ?>"
                   class="form-control">

        </div>

        <br>

        <?= Html::submitButton('Update', [
            'class' => 'btn btn-primary'
        ]) ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>
