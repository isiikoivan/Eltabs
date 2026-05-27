<?php

namespace app\components;

use Yii;

/**
 * EltabsMenuRegistry serves as the centralized master data hub for tab navigation.
 * * DESIGN PRINCIPLE: Instead of embedding UI links, access permissions, and visibility rules
 * across dozens of isolated view files, this registry decouples layout metadata into a
 * single configuration dictionary grouped systematically by active Controller ID keys.
 */
class EltabsMenuRegistry
{
    /**
     * Retrieves the structural layout matrix and access rules for a specified controller domain.
     * * @param string $key The unique identifier tracking the active controller (e.g., Yii::$app->controller->id)
     * @return array The configuration matrix containing matching navigation tabs or an empty fallback array.
     */
    public static function getTabs($key)
    {
        // Global navigation registry container matrix
        $configs = [

            // =========================================================================
            // 1. STUDENT MODULE SYSTEM DEFINITIONS
            // =========================================================================
            'student' => [

                // ── GLOBAL MODULE LEVEL ACTIONS SHORTCUT ──
                // CRITICAL CORRECTION: Contains ONLY formal Yii2 action IDs (like 'index', 'view')
                // matching $currentAction. We omit raw parameter strings here.
                // The widget reads this pool during Pass 2 to verify if an unknown sub-action
                // (like 'update' or 'view') belongs to this domain before firing string scanners.
                'refActions' => ['index', 'create', 'update', 'view', 'attendance', 'fees'],

                // ── INDIVIDUAL NAV TAB CONFIGURATIONS ──
                'list' => [
                    'label'       => 'Student Roster',
                    'url'         => ['/student/index'],
                    // Cross-Controller Scope: Tells the widget that this specific tab remains
                    // processable even if the application lifecycle routes into an entirely different controller.
                    'controllers' => ['student', 'attendance'],
                    // Pass 1 Targets: Direct landing routes. While on actionIndex or actionCreate,
                    // the two-pass widget claims an immediate exact match, locking down the layout
                    // and completely skipping Pass 2 string searches to prevent false positives.
                    'actions'     => ['index', 'create'],
                    // Pass 2 Context Token: Used when viewing or updating deep nested records.
                    // While on a route like '/student/view?id=5&ref=student', Pass 2 checks if this
                    // reference key lives inside the URL/Referrer to safely preserve the highlighted tab.
                    'ref'         => 'student',
                    'visible'     => true         // RBAC Base Rule: Standard true/false baseline visibility
                ],
                'attendance' => [
                    'label'       => 'Attendance Log',
                    'url'         => ['/student/attendance'],
                    'controllers' => ['student'],
                    'actions'     => ['attendance'], // Exact action landing target
                    'ref'         => 'attendance',
                    // 'visible'  => Yii::$app->user->can('view-attendance-logs') // Dynamic RBAC authorization guard example
                ],
                'fees' => [
                    'label'       => 'Fee Statements',
                    'url'         => ['/student/fees'],
                    'controllers' => ['student'],
                    'actions'     => ['fees'],       // Exact action landing target
                    'ref'         => 'fees',
                    // 'visible'  => Yii::$app->user->can('manage-school-billing') // Dynamic financial access guard example
                ],
            ],

            // =========================================================================
            // 2. GEOGRAPHICAL REGION MODULE SETTINGS (Cross-Controller Submenu Sync)
            // =========================================================================
            'country' => [

                // ── GLOBAL CONTROLLER MODULE ACTIONS SHORTCUT ──
                // Sets the universal tracking action boundary for the geographical schema management views.
                'refActions' => ['index', 'create', 'update', 'view'],

                'create' => [
                    'label'       => 'Country',
                    'url'         => ['/country/index'],
                    'controllers' => ['country'],
                    'actions'     => ['index', 'create'],
                    'ref'         => 'view', // Sniffs sub-view operations for country elements
                ],
                'region' => [
                    'label'       => 'Region',
                    'url'         => ['/region/index'],
                    // Dynamic Routing Link: Points across separate controllers to form a unified submenu.
                    'controllers' => ['region'],
                    'actions'     => ['index', 'create'],
                    'ref'         => 'region',
                ]
            ],

            // ── COMPANION CONTEXT ROUTING MIRROR ──
            // ARCHITECTURAL NECESSITY: When a user clicks the "Region" tab, Yii2 switches controllers
            // from 'country' to 'region'. By duplicating the exact submenu matrix under the 'region' key,
            // we ensure the tab row remains perfectly rendered and visually stable across controller contexts.
            'region' => [
                'refActions' => ['index', 'create', 'update', 'view'],
                'create' => [
                    'label'       => 'Country',
                    'url'         => ['/country/index'],
                    'controllers' => ['country'],
                    'actions'     => ['index', 'create'],
                    'ref'         => 'view',
                ],
                'region' => [
                    'label'       => 'Region',
                    'url'         => ['/region/index'],
                    'controllers' => ['region'],
                    'actions'     => ['index', 'create'],
                    'ref'         => 'region',
                ]
            ]
        ];

        // SAFEGUARD EVALUATION CHECK:
        // Return the requested module configuration matrix if matched inside the array data pool,
        // or return an empty array if the matching controller key configuration isn't defined yet.
        return isset($configs[$key]) ? $configs[$key] : [];
    }
}
