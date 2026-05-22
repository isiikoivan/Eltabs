<?php

use yii\helpers\Html;

$this->title = 'View Country';

?>

<div class="card">
    <div class="card-header">
        <h4>Country Details</h4>
    </div>

    <div class="card-body">

        <p><strong>ID:</strong> <?= $model['id'] ?></p>

        <p><strong>Description:</strong> <?= $model['description'] ?></p>

        <p><strong>Code:</strong> <?= $model['code'] ?? 'UG' ?></p>

        <p><strong>Status:</strong> <?= $model['status'] ?? 'Active' ?></p>

        <p><strong>Created On:</strong> <?= $model['created_on'] ?? date('Y-m-d') ?></p>

    </div>
</div>
