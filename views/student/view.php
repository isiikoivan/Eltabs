<?php

$this->title = 'View Student';

?>

<div class="card">

    <div class="card-header">
        <h4>Student Details</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <td><?= $student['id'] ?></td>
            </tr>

            <tr>
                <th>Name</th>
                <td><?= $student['name'] ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?= $student['email'] ?></td>
            </tr>

            <tr>
                <th>Course</th>
                <td><?= $student['course'] ?></td>
            </tr>

            <tr>
                <th>Attendance</th>
                <td><?= $student['attendance'] ?></td>
            </tr>

            <tr>
                <th>Fees</th>
                <td><?= $student['fees'] ?></td>
            </tr>

        </table>

    </div>

</div>