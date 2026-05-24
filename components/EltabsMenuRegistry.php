<?php

namespace app\controllers;

class EltabsMenuRegistry
{
    /**
     * Central map of controller actions and structural access control criteria.
     */
    public static function getTabs($key)
    {
        $configs = [
            //  Sample Registry Entry: Student Module through the action id
            'student' => [
                'list' => [
                    'label'       => 'Student Roster',
                    'url'         => ['/student/index'],
                    'controllers' => ['student'],
                    'actions'     => ['index', 'create', 'update', 'view'],
                    'ref'         => 'students',
                    'visible'     => true // Standard visibility rule by default its true if not set
                ],
                'attendance' => [
                    'label'       => 'Attendance Log',
                    'url'         => ['/student/attendance'],
                    'controllers' => ['student'],
                    'actions'     => ['attendance'],
                    'ref'         => 'attendance',
//                    'visible'     => Yii::$app->user->can('view-attendance-logs') // RBAC permission evaluation
                ],
                'fees' => [
                    'label'       => 'Fee Statements',
                    'url'         => ['/student/fees'],
                    'controllers' => ['student'],
                    'actions'     => ['fees'],
                    'ref'     => 'fees',
//                    'visible'     => Yii::$app->user->can('manage-school-billing') // Billing rule guard
                ],
            ],
        ];

        return isset($configs[$key]) ? $configs[$key] : [];
    }
}
