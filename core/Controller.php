<?php
abstract class Controller{
	protected $request;
	protected $action;

	public function __construct($action, $request){
		$this->action = $action;
		$this->request = $request;
	}

	public function executeAction(){
		return $this->{$this->action}();
	}

	protected function returnView($viewmodel, $path, $fullview){
		//$view = 'views/'. get_class($this). '/' .$this->action. '.php';
		$view = 'views/pages/'. $path . '.php';
		$isLoggedIn = Session::get('isLoggedIn');
		$userDetails = Session::get('userDetails');
		if($fullview){
			require('views/main.php');
		} else {
			require($view);
		}
        Session::flash('old');
	}
}