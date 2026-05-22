<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class StudentController extends Controller
{
    /**
     * Main layout
     */
    public $layout = 'main';

    /**
     * Dummy student records
     */
    private function getStudents()
    {
        return [

            [
                'id' => 1,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'course' => 'Computer Science',
                'attendance' => '92%',
                'fees' => 'Paid'
            ],

            [
                'id' => 2,
                'name' => 'Sarah Smith',
                'email' => 'sarah@example.com',
                'course' => 'Business Administration',
                'attendance' => '85%',
                'fees' => 'Pending'
            ],

            [
                'id' => 3,
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'course' => 'Software Engineering',
                'attendance' => '96%',
                'fees' => 'Paid'
            ],

            [
                'id' => 4,
                'name' => 'Linda Green',
                'email' => 'linda@example.com',
                'course' => 'Accounting',
                'attendance' => '78%',
                'fees' => 'Partial'
            ],

        ];
    }

    /**
     * Find single student
     */
    private function findStudent($id)
    {
        foreach ($this->getStudents() as $student) {

            if ($student['id'] == $id) {
                return $student;
            }
        }

        throw new \yii\web\NotFoundHttpException(
            'Student not found.'
        );
    }

    /**
     * Student listing
     */
    public function actionIndex()
    {
        $students = $this->getStudents();

        return $this->render('index', [
            'students' => $students,
        ]);
    }

    /**
     * Student details
     */
    public function actionView($id)
    {
        $student = $this->findStudent($id);

        return $this->render('view', [
            'student' => $student,
        ]);
    }

    /**
     * Create student page
     */
    public function actionCreate()
    {
        return $this->render('create', [

            'student' => [
                'name' => '',
                'email' => '',
                'course' => '',
            ]

        ]);
    }

    /**
     * Update student
     */
    public function actionUpdate($id)
    {
        $student = $this->findStudent($id);

        return $this->render('update', [
            'student' => $student,
        ]);
    }

    /**
     * Attendance page
     */
    public function actionAttendance()
    {
        $attendance = [

            [
                'student' => 'John Doe',
                'course' => 'Computer Science',
                'attendance' => '92%',
            ],

            [
                'student' => 'Sarah Smith',
                'course' => 'Business Administration',
                'attendance' => '85%',
            ],

            [
                'student' => 'Michael Brown',
                'course' => 'Software Engineering',
                'attendance' => '96%',
            ],

        ];

        return $this->render('attendance', [
            'attendance' => $attendance,
        ]);
    }

    /**
     * Fees page
     */
    public function actionFees()
    {
        $fees = [

            [
                'student' => 'John Doe',
                'status' => 'Paid',
                'amount' => 'UGX 1,200,000',
            ],

            [
                'student' => 'Sarah Smith',
                'status' => 'Pending',
                'amount' => 'UGX 850,000',
            ],

            [
                'student' => 'Linda Green',
                'status' => 'Partial',
                'amount' => 'UGX 600,000',
            ],

        ];

        return $this->render('fees', [
            'fees' => $fees,
        ]);
    }
}