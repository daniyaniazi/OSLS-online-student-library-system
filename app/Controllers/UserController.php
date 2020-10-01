<?php
class UserController extends Controller{

    public function __construct($action, $request)
    {
        parent::__construct($action, $request);
        $this->viewmodel = new UserModel();
    }

    public function index(){
        $this->returnView(null, 'login', true);
    }

    public function signup(){
        $this->returnView(null, 'signup',true);
    }

    public function postSignUp(){
        $this->viewmodel->register();
    }

    public function login(){
        //$viewmodel = new UserModel();
        $this->returnView(null, 'login', true);
    }

    public function postLogin(){
        //$viewmodel = new UserModel();
        $this->viewmodel->login();
    }

    public function logout(){
        Session::delete('isLoggedIn');
        Session::delete('userDetails');
        Session::deleteAll();
        // Redirect
        header('Location: '.base_url());
    }
}