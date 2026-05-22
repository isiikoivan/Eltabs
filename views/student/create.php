<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Student';

?>

<div class="card">

    <div class="card-header">
        <h4>Create Student</h4>
    </div>

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="mb-3">

            <label>Name</label>

            <input
                type="text"
                class="form-control"
                value="<?= $student['name'] ?>"
            >

        </div>

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                class="form-control"
                value="<?= $student['email'] ?>"
            >

        </div>

        <div class="mb-3">

            <label>Course</label>

            <input
                type="text"
                class="form-control"
                value="<?= $student['course'] ?>"
            >

        </div>

        <?= Html::submitButton(
            'Save Student',
            ['class' => 'btn btn-success']
        ) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>