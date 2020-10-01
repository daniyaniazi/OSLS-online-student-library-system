<?php

require_once 'vendor/sendgrid-php/sendgrid-php.php';

class ContactController extends Controller{
    public function __construct($action, $request)
    {
        parent::__construct($action, $request);
    }

    public function index(){
        //$viewmodel = new ShareModel();
        $this->returnView(null, 'contact', true);
    }

    public function send(){
        error_reporting(E_ALL);
        global $appConfig;
        $request = $this->request;

        $auditEmail = $request['email'];
        $contactName = $request['contactName'];
        $message = "<p><strong>From Email : </strong>$auditEmail</p>". "<p>" .$request['message'] ."</p>";
        $subject = $appConfig['contactSubject'];

        // $viewmodel = new ShareModel();
        // debugger(SENDGRID_API_KEY);

        $email = new SendGrid\Mail\Mail();
        $email->setFrom("hassan.ali@mikaels.com", $contactName);
        $email->setSubject($subject);
        $email->addTo($auditEmail, "");
        $email->addContent(
            "text/html", $message
        );
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);

        try {
            $response = $sendgrid->send($email);
            Messages::setMsg('Contact email sent successfully', 'success');
            header('Location: '.base_url('contact'));
            return;
        } catch (Exception $e) {
            Messages::setMsg($e->getMessage(), 'error');
            header('Location: '.base_url('contact'));
            return;
        }

        //$this->returnView(null, 'contact', true);
    }
}