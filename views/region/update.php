<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Region';

?>

<div class="card">

    <div class="card-header">
        <h4>Update Region</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">

            <label>Region Name</label>

            <input type="text"
                   name="description"
                   value="<?= $model['description'] ?>"
                   class="form-control">

        </div>

        <br>

        <div class="form-group">

            <label>Country</label>

            <select class="form-control" name="country_id">

                <option value="">Select Country</option>

                <option value="1"
                    <?= $model['country_id'] == 1 ? 'selected' : '' ?>>
                    Uganda
                </option>

                <option value="2"
                    <?= $model['country_id'] == 2 ? 'selected' : '' ?>>
                    Kenya
                </option>

            </select>

        </div>

        <br>

        <?= Html::submitButton('Update', [
            'class' => 'btn btn-primary'
        ]) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
