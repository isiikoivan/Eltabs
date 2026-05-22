<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Students';

?>

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h4>Students</h4>

        <?= Html::a(
            'Create Student',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Attendance</th>
                <th>Fees</th>
                <th>Actions</th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($students as $student): ?>

                <tr>

                    <td><?= $student['id'] ?></td>

                    <td><?= $student['name'] ?></td>

                    <td><?= $student['email'] ?></td>

                    <td><?= $student['course'] ?></td>

                    <td><?= $student['attendance'] ?></td>

                    <td><?= $student['fees'] ?></td>

                    <td>

                        <?= Html::a(
                            'View',
                            [
                                'view',
                                'id' => $student['id'],
//                                'tab' => 'students'
                            ],
                            ['class' => 'btn btn-sm btn-primary']
                        ) ?>

                        <?= Html::a(
                            'Update',
                            [
                                'update',
                                'id' => $student['id'],
//                                'tab' => 'students'
                            ],
                            ['class' => 'btn btn-sm btn-warning']
                        ) ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>