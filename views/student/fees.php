<?php

$this->title = 'Fees';

?>

<div class="card">

    <div class="card-header">
        <h4>Fees Information</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

            <tr>
                <th>Student</th>
                <th>Status</th>
                <th>Amount</th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($fees as $row): ?>

                <tr>

                    <td><?= $row['student'] ?></td>

                    <td><?= $row['status'] ?></td>

                    <td><?= $row['amount'] ?></td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>