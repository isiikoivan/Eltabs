<?php

namespace app\components;

use Yii;
use yii\base\Widget;

class EltabsMenuWidget extends Widget
{
    /** * @var array The tab menu items configuration matrix passed from layout/registry
     */
    public $items = [];

    /** * @var string Fallback controller ID match context
     */
    public $controllerId = '';

    /**
     * Initializes the widget and handles default controller fallback configurations.
     */
    public function init()
    {
        parent::init();
        if (empty($this->controllerId)) {
            $this->controllerId = Yii::$app->controller->id;
        }
    }

    /**
     * Executes the widget logic, filters hidden tabs, parses current states, and renders HTML.
     * @return string Rendered HTML menu markup or empty string
     */
    public function run()
    {
        if (empty($this->items)) {
            return '';
        }

        $currentController = Yii::$app->controller->id;
        $currentAction = Yii::$app->controller->action->id;

        // Backward-compatible alternative to accomodate (old php and new versions)
        $referrer   = isset(Yii::$app->request->referrer) ? Yii::$app->request->referrer : '';
        $currentUrl = isset(Yii::$app->request->url) ? Yii::$app->request->url : '';

        foreach ($this->items as $id => $item) {

            // El-Tabs: RBAC / Visibility Guard
            // If visibility rule evaluates to false, drop the tab immediately from the execution queue
            if (isset($item['visible']) && $item['visible'] === false) {
                unset($this->items[$id]);
                continue;
            }

            // Set default active property safely
            $this->items[$id]['active'] = false;

            // Step 1: Validate Controller Context Scope
            $controllerMatch = false;
            if (isset($item['controllers'])) {
                $controllerMatch = in_array($currentController, (array)$item['controllers']);
            } else {
                $controllerMatch = ($currentController === $this->controllerId);
            }

            if ($controllerMatch) {
                // Tier 1: Direct Action Match (Highest operational priority)
                if (isset($item['actions']) && in_array($currentAction, $item['actions'])) {
                    $this->items[$id]['active'] = true;
                }

                // Tier 2: Referrer Sniffing (Keeps state active when loading details views from a tab list)
                if (!$this->items[$id]['active'] && $currentAction === 'view' && isset($item['ref'])) {
                    if (strpos($referrer, (string)$item['ref']) !== false) {
                        $this->items[$id]['active'] = true;
                    }
                }

                // Tier 3: URL Param Fallback (State persistence for page reloads, bookmarks, and back button)
                if (!$this->items[$id]['active'] && $currentAction === 'view' && isset($item['ref'])) {
                    if (strpos($currentUrl, (string)$item['ref']) !== false) {
                        $this->items[$id]['active'] = true;
                    }
                }
            }
        }

        $this->registerClientAssets();
        return $this->render('eltabs_menu', ['items' => $this->items]);
    }

    protected function registerClientAssets()
    {
        $css = "
            .sub-menu-location-tabs { display: flex; flex-wrap: wrap; list-style: none; padding: 0; border-bottom: 2px solid #ddd; gap: 5px; margin-bottom: 20px; }
            .sub-menu-location-tabs .clink_location a { display: block; padding: 10px 18px; text-decoration: none; color: #555; background: #f5f5f5; border: 1px solid #ddd; border-bottom: none; border-radius: 6px 6px 0 0; transition: all 0.2s ease-in-out; font-size: 14px; }
            .sub-menu-location-tabs .clink_location a:hover { background: #e9ecef; color: #000; }
            .sub-menu-location-tabs .clink_location.active a { background: #ffffff; color: #000; font-weight: 600; border-bottom: 2px solid #ffffff; position: relative; top: 2px; }
        ";
        $this->view->registerCss($css);
    }
}
