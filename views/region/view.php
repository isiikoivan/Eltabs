<?php

$this->title = 'View Region';

?>

<div class="card">

    <div class="card-header">
        <h4>Region Details</h4>
    </div>

    <div class="card-body">

        <p><strong>ID:</strong> <?= $model['id'] ?></p>

        <p><strong>Region:</strong> <?= $model['description'] ?></p>

        <p><strong>Country:</strong> <?= $model['country'] ?></p>

        <p><strong>Status:</strong> <?= $model['status'] ?? 'Active' ?></p>

        <p><strong>Created On:</strong> <?= $model['created_on'] ?></p>

    </div>

</div>
