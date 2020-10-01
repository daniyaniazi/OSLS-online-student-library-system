<?php
class Messages{
	public static function setMsg($text, $type){
		if($type == 'error'){
			$_SESSION['errorMsg'] = $text;
		} else {
			$_SESSION['successMsg'] = $text;
		}
	}

	public static function display(){
		if(isset($_SESSION['errorMsg'])){
			echo '<div class="alert alert-danger"><span>'.htmlspecialchars_decode($_SESSION['errorMsg']).' </span><i class="fa fa-exclamation-triangle pull-right" aria-hidden="true"></i></div>';
			unset($_SESSION['errorMsg']);
		}

		if(isset($_SESSION['successMsg'])){
			echo '<div class="alert alert-success"><i class="fa fa-check-square-o pull-right" aria-hidden="true"></i> <span> '.$_SESSION['successMsg'].' </span><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
			unset($_SESSION['successMsg']);
		}
	}
}