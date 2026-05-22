<?php

$this->title = 'Attendance';

?>

<div class="card">

    <div class="card-header">
        <h4>Attendance Records</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

            <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Attendance</th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($attendance as $row): ?>

                <tr>

                    <td><?= $row['student'] ?></td>

                    <td><?= $row['course'] ?></td>

                    <td><?= $row['attendance'] ?></td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>