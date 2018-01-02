<?php

 class Bootstrap {
    protected $_params = array();

    public function __construct() {
        $this->extractUrl();

        $module = $this->_params['module'] ? $this->_params['module'] : "default";
        $controller = $this->_params['controller'] ? $this->_params['controller'] : "welcome";
        $action = $this->_params['action'] ? $this->_params['action'] : "index";
        require_once("application/modules/$module/controllers/$controller.php");
        $objController = new $controller;
        $objController->$action();              
    }

    protected function extractUrl() {
        if(isset($_GET['url'])) {
            $url = explode('/', $_GET['url']);
            $this->_params['module'] = isset($url[0]) ? $url[0] : null;
            $this->_params['controller'] = isset($url[1]) ? $url[1] : null;
            $this->_params['action'] = isset($url[2]) ? $url[2] : null;
        }
    }   
}