<?php
class UserModel extends Model{
    public function register(){
        // Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $post = array_map( 'sanitize',$post);

        if(!empty($post['password'])){
            $password = md5($post['password']);
        }

        if($post['submit']){

            if($post['name'] == '' || $post['email'] =='' || $post['password'] == ''){
                Session::flash('old',$post);
                Messages::setMsg('You must fill in all the fields', 'error');
                header('Location: '.base_url('user/signup'));
                return;
            }

            if($this->checkEmailExist($post['email'])){
                Session::flash('old',$post);
                Messages::setMsg("Email address <b> {$post['email']} </b> already taken by other. Please try another", 'error');
                header('Location: '.base_url('user/signup'));
                return;
            }

            // Insert into MySQL
            $this->query('INSERT INTO users(name, email, password,contact_no) VALUES(:name, :email, :password, :contact_no)');
            $this->bind(':name', $post['name']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->bind(':contact_no', $post['contact_no']);
            $this->execute();

            // Verify
            if($this->lastInsertId()){
                // Redirect
                header('Location: '.base_url('user/login'));
            }
        }
        return;
    }

    public function login(){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $post = array_map( 'sanitize',$post);


        if($post['email'] =='' || $post['password'] == ''){
            Session::flash('old',$post);
            Messages::setMsg('You must fill in all the fields', 'error');
            header('Location: '.base_url('user/login'));
            return;
        }

        if(!empty($post['password'])) {
            $password = md5($post['password']);
        }

        if($post['submit']){
            // Compare login
            $this->query('SELECT * FROM users WHERE email=:email AND password=:password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);

            $row = $this->single();
            if($row){
                Session::put('isLoggedIn',true);
                Session::put('userDetails'  , array(
                    "id" 	=> $row['id'],
                    "name"	=> $row['name'],
                    "email"	=> $row['email'],
                    "contact_no" => $row['contact_no'],
                ));
                header('Location: '.base_url());
            } else {
                Session::flash('old',$post);
                Messages::setMsg('The email & password you entered did not match our records.', 'error');
                header('Location: '.base_url('user/login'));
                return;
            }
        }
        return;
    }

    public function checkEmailExist($email){
        $this->query("SELECT * FROM users WHERE email= :email");
        $this->bind(':email', $email);
        $emailExist = $this->resultSet();
        return count($emailExist)>0 ? true : false;
    }
}