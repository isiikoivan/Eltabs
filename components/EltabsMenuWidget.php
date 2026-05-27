<?php

namespace app\components;

use Yii;
use yii\base\Widget;

/**
 * EltabsMenuEngine handles advanced contextual tab navigation layout tracking.
 * * It automatically maps active menu highlights across complex CRUD workflows,
 * handles custom controller configurations, parses camelCase vs kebab-case URLs,
 * and gracefully enforces RBAC visibility permissions on a per-tab basis.
 */
class EltabsMenuEngine extends Widget
{
    /** * @var array The tab menu items configuration matrix passed from layout or registry.
     */
    public $items = [];

    /** * @var string Fallback controller ID match context (defaults to active controller).
     */
    public $controllerId = '';

    /** * @var array Flat list of all valid action IDs that trigger reference state tracking.
     */
    public $refActions = [];

    /**
     * Initializes the widget and handles default controller fallback configurations.
     */
    public function init()
    {
        // Execute the native parent component initialization rules first
        parent::init();

        // If an explicit controller context wasn't passed to the widget configuration,
        // automatically capture the current executing controller ID from the Yii application lifecycle.
        if (empty($this->controllerId)) {
            $this->controllerId = Yii::$app->controller->id;
        }
    }

    /**
     * Executes the widget logic, filters hidden tabs, parses active states, and renders HTML.
     * * @return string Rendered HTML menu markup or empty string
     */
    public function run()
    {
        // GUARD CLAUSE: Exit early and output nothing if no menu layout configurations exist.
        if (empty($this->items)) {
            return '';
        }

        // 1. COMPONENT DATA COLLECTION LAYER
        // Extract plain string identifiers and object references from the active application instance.
        // Yii::$app->controller acts as a direct reference link to whichever controller class is
        // currently handling the executing lifecycle of the web request.
        $currentControllerId = Yii::$app->controller->id;       // e.g., 'student'
        $currentAction       = Yii::$app->controller->action->id; // e.g., 'index', 'view', or 'attendance'
        $controllerObject    = Yii::$app->controller;           // The live controller instance object

        // Backward-compatible stream extraction to safely support older PHP 5.6/7.0 and modern PHP 8.x servers
        $referrer   = isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : '';
        $currentUrl = isset(Yii::$app->request->url) ? Yii::$app->request->url : '';

        // 2. CONFIGURATION & DATA RECOVERY HOOK (refActions Parsing)
        // Check if the developer defined a centralized global 'refActions' shortcut list in their registry block.
        // Moving refActions up to the top level of the configuration creates a clean, global routing context
        // for the entire module, allowing us to completely bypass reflection overhead.
        $this->refActions = [];
        if (isset($this->items['refActions'])) {
            // Cast to an array for structure normalization, then assign it to our tracking processor
            $this->refActions = (array)$this->items['refActions'];

            // CRITICAL CLEANUP: Strip out this configuration key so it doesn't accidentally
            // render as an empty, broken tab item down in the presentation HTML view markup loop.
            unset($this->items['refActions']);
        } else {
            // FALLBACK DYNAMIC HARVESTER ENGINE: Runs only if the developer did NOT define a global 'refActions' array.
            // This safely reflects into the active controller to discover routes automatically.
            // NOTE: Calling $controller->actions() only returns standalone, external actions declared inside the
            // controller's actions() map. It will not find your standard internal inline actions (like actionView).
            // Therefore, we use get_class_methods to scrape the class methods directly.
            $controllerMethods = get_class_methods($controllerObject);
            if (is_array($controllerMethods)) {
                foreach ($controllerMethods as $method) {
                    // Filter down to public methods starting with the word 'action' (excluding the core 'actions' mapping method)
                    if (strpos($method, 'action') === 0 && $method !== 'actions') {
                        // Extract the raw action suffix by removing the first 6 characters ('action')
                        $rawActionName = substr($method, 6);

                        // KEBAB-CASE TRANSLATION: URL routes convert CamelCase actions into hyphens (e.g., actionFeedAnimals -> feed-animals).
                        // This regex inserts a hyphen before any capital letter that isn't at the start, then converts the string to lowercase.
                        $this->refActions[] = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $rawActionName));

                        // Standard camelCase variant fallback tracking (e.g., maps to internal action tracking keywords like 'feedAnimals')
                        $this->refActions[] = lcfirst($rawActionName);
                    }
                }
            }
            // Include external standalone action mapping classes if they are declared
            if (method_exists($controllerObject, 'actions')) {
                $this->refActions = array_merge($this->refActions, array_keys($controllerObject->actions()));
            }
        }

        // STATE-BLEEDING AND PERFORMANCE GUARD SWITCH
        // This master control variable acts as a toggle latch. The very instant any single tab
        // row claims the active highlight status, this flips to 'true'.
        // This effectively locks out all downstream tabs from evaluating fallback rules,
        // completely eliminating the bug where multiple tabs light up on a single page view.
        $menuHasActiveTab = false;

        // ── PASS 1: EXCLUSIVE DIRECT MATCH CHECK ──
        // Prioritize explicit actions first to ensure direct hits always override string sniffing fallbacks.
        // This forces explicit action hits to win immediately, preventing fallback logic from bleeding states.
        foreach ($this->items as $id => $item) {
            // EL-TABS COMPONENT CORE GUARD: Dynamic RBAC Visibility Enforcement
            // Inspect if a custom visibility boolean rule or RBAC permissions callback has been passed.
            // If explicitly declared false, completely prune the element from the data pool and skip processing.
            if (isset($item['visible']) && $item['visible'] === false) {
                unset($this->items[$id]);
                continue;
            }

            // DEFENSIVE PROGRAMMING INITIALIZATION
            // Explicitly force the current tab row's active state back to false. This wipes out
            // any stale memory data or dirty state configurations carried over from previous operations.
            $this->items[$id]['active'] = false;

            // STEP 1: VALIDATE CONTROLLER CONTEXT SCOPE MATCHING
            // Determine if the currently executing controller matches the allowed domain of this specific tab row.
            $controllerMatch = isset($item['controllers'])
                ? in_array($currentControllerId, (array)$item['controllers'])
                : ($currentControllerId === $this->controllerId);

            // If the active controller is matched, check for direct action match rules
            if ($controllerMatch) {
                // TIER 1: DIRECT ACTION MATCHING (Absolute Route Operational Precedence)
                // If the requested action ID lives explicitly within this tab's primary target actions array
                // (e.g., viewing index, attendance, or fees landing pages), it represents a guaranteed match.
                if (isset($item['actions']) && in_array($currentAction, $item['actions'])) {
                    $this->items[$id]['active'] = true;
                    $menuHasActiveTab = true; // Engage the master short-circuit lock immediately
                }
            }
        }

        // ── PASS 2: FALLBACK SNIFFING LOOP ──
        // Only trigger string scans if no direct action match was claimed during Pass 1.
        // This architectural wall ensures that landing pages never run string sniffing algorithms.
        if (!$menuHasActiveTab && in_array($currentAction, $this->refActions)) {
            foreach ($this->items as $id => $item) {
                if (isset($item['ref'])) {
                    $searchToken = (string)$item['ref'];

                    // COMBINED TIER 2 & TIER 3 STRING SCANNING
                    // Tier 2 (Referrer): Captures natural internal click transitions between pages.
                    // Tier 3 (Current URL): Acts as a backup safety net to catch page refreshes (F5), bookmarks,
                    // and back/forward browser history actions when the HTTP Referrer header is wiped.
                    if (strpos($referrer, $searchToken) !== false || strpos($currentUrl, $searchToken) !== false) {
                        $this->items[$id]['active'] = true;
                        $menuHasActiveTab = true; // Lock down to prevent multiple sniffing selections
                        break; // Stop looking immediately to enforce a strict single-active-tab rule
                    }
                }
            }
        }

        // 4. PRESENTATION STYLING & COMPILATION OUTPUT
        // Inject layout client styles to ensure visual isolation, then compile and stream the finalized template.
        $this->registerClientAssets();
        return $this->render('eltabs_menu', ['items' => $this->items]);
    }

    /**
     * Registers context-isolated layout client presentation styles cleanly over the application view instance.
     */
    protected function registerClientAssets()
    {
        $css = "
            .sub-menu-location-tabs { display: flex; flex-wrap: wrap; list-style: none; padding: 0; border-bottom: 2px solid #ddd; gap: 5px; margin-bottom: 20px; }
            .sub-menu-location-tabs .clink_location a { display: block; padding: 10px 18px; text-decoration: none; color: #555; background: #f5f5f5; border: 1px solid #ddd; border-bottom: none; border-radius: 6px 6px 0 0; transition: all 0.2s ease-in-out; font-size: 14px; }
            .sub-menu-location-tabs .clink_location a:hover { background: #e9ecef; color: #000; }
            .sub-menu-location-tabs .clink_location.active a { background: #ffffff; color: #000; font-weight: 600; border-bottom: 2px solid #ffffff; position: relative; top: 2px; }
        ";

        // Register standard styles gracefully onto the view layout manager stack
        $this->view->registerCss($css);
    }
}
