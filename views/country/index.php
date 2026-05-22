<?php

use yii\helpers\Html;

$this->title = 'Countries';

?>

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Countries</h4>

        <?= Html::a('Create Country', ['create'], [
            'class' => 'btn btn-primary btn-sm'
        ]) ?>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Code</th>
                <th>Status</th>
                <th width="200">Action</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($dataProvider as $row): ?>

                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['status'] ?></td>

                    <td>
                        <?= Html::a('View',
                            ['view', 'id' => $row['id']],
                            ['class' => 'btn btn-info btn-sm']
                        ) ?>

                        <?= Html::a('Update',
                            ['update', 'id' => $row['id']],
                            ['class' => 'btn btn-warning btn-sm']
                        ) ?>

                        <?= Html::a('Delete',
                            ['delete', 'id' => $row['id']],
                            [
                                'class' => 'btn btn-danger btn-sm',
                                'data-method' => 'post',
                                'data-confirm' => 'Are you sure?'
                            ]
                        ) ?>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

    </div>
</div>
