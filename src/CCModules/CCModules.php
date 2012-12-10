<?php

/**
 * Description of CCModules
 *
 * @package konturCore
 */
class CCModules extends CObject implements IController {

    /**
     * constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * index 
     */
    public function Index() {
        $modules = new CMModules();
        $controllers = $modules->AvailableControllers();
        $allModules = $modules->ReadAndAnalyse();
        $this->views->SetTitle('Manage Modules')->AddInclude(__DIR__ . '/index.tpl.php', array('controllers' => $controllers), 'primary')
                ->AddInclude(__DIR__ . '/sidebar.tpl.php', array('modules' => $allModules), 'sidebar');
    }

    /**
     * install - starts install process for kontur 
     */
    public function Install() {
        $modules = new CMModules();
        $results = $modules->Install();
        $allModules = $modules->ReadAndAnalyse();
        $this->views->SetTitle('Install Modules')->AddInclude(__DIR__ . '/install.tpl.php', array('modules' => $results), 'primary')->AddInclude(__DIR__ . '/sidebar.tpl.php', array('modules' => $allModules), 'sidebar');
    }

    /**
     * view - displays documentation for kontur 
     * @param type $module
     * @throws Exception
     */
    public function View($module) {
        if (!preg_match('/^C[a-zA-Z]+$/', $module)) {
            throw new Exception('Invalid characters in module name.');
        }
        $modules = new CMModules();
        $controllers = $modules->AvailableControllers();
        $allModules = $modules->ReadAndAnalyse();
        $aModule = $modules->ReadAndAnalyseModule($module);
        $this->views->SetTitle('Manage Modules')
                ->AddInclude(__DIR__ . '/view.tpl.php', array('module' => $aModule), 'primary')
                ->AddInclude(__DIR__ . '/sidebar.tpl.php', array('modules' => $allModules), 'sidebar');
    }

}

?>
