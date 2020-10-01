<?php
require('config/route.php');

class Bootstrap{
	private $controller;
	private $action;
	private $request;
	private $appPath = 'app/';

	public function __construct($request){
	    global $routes;
		$this->request = $request;
		$controller = $this->request['controller'];
		$action = $this->request['action'];

		if($controller==""){
			$this->controller= 'BookController';
		} else {
		    if( array_key_exists($controller,$routes) ){
                $this->controller = $routes[$controller]['controller'];
            }
		}
		if($this->request['action'] == ""){
			$this->action='index';
		} else {
			$this->action = $this->request['action'];
		}
	}


	public function createController(){
		//Check Class
		if(class_exists($this->controller)){
			$parents = class_parents($this->controller);
			//Check extend
			if(in_array("Controller", $parents)){
				if(method_exists($this->controller, $this->action)){
					return new $this->controller($this->action, $this->request);
				} else {
					// Method Does Not Exist
					echo '<h1>Mehtod does not exist</h1>';
					return;
				}
			} else {
				// Base controller does not exist
				echo '<h1>Base controller not found</h1>';
				return;
			}
		} else {
			// Contorller Class does not exist
			echo '<h1>Controller class does not exist</h1>';
			return;
		}
	}
}