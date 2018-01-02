<?php

class BaseController {
    public $load;
    public $model;

    public function __construct() {
        $this->load = $this;
    }

    public function view($path = "",$data = array()) {
        foreach($data as $key=>$value) {
            $$key = $value;
        }
        $params = $_REQUEST;
        $module = isset($params['module']) && $params['module'] != "" ? $params['module'] : "default";
        require_once("application/modules/{$module}/views/{$path}.phtml");
    }

    public function model($modelName = "") {
        if($modelName == "") {
            return false;
        }
        $params = $_REQUEST;
        $module = isset($params['module']) && $params['module'] != "" ? $params['module'] : "default";
        require_once("application/modules/{$module}/models/{$modelName}.php");
        $this->model = new $modelName;
    }
}