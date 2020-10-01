<?php
require './config/app.php';

class BookModel extends Model{
    public function index(){
        global  $appConfig;
        $limit = $appConfig['itemsPerPage'];
        $where = [];

        $this->getBooks();

        $this->bind(':limit', $limit);
        $this->bind(':offset', 0);
        $rows= $this->resultSet();
        return $rows;
    }

    public function getBooks($action = ''){
        if( !Session::get('isLoggedIn') ){
            $this->query('SELECT * FROM books 
                WHERE visibility = 1        
                ORDER BY id DESC LIMIT :offset, :limit'
            );
        }else{
            $this->query('SELECT * FROM books 
                WHERE (user_id = :userID AND visibility = 0) 
                OR ( visibility = 1 )        
                ORDER BY id DESC LIMIT :offset, :limit'
            );
            $this->bind(':userID', Session::get('userDetails')['id']);
        }
    }

    public function add(){
        // Sanitize Post
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['submit']){

            if(!Session::get('isLoggedIn')){
                header('Location: '.base_url('user/login'));
            }

            if($post['title'] == '' || $post['author'] =='' || $post['visibility'] == ''){
                Session::flash('old',$post);
                Messages::setMsg('You must fill in all the fields', 'error');
                header('Location: '.base_url('book/add'));
                return;
            }

            $bookImage = null;
            $bookDoc = null;

            if(isset($_FILES['book_image'])){
                $bookImage  = $this->upload($_FILES['book_image'],'images');

                if(!$bookImage){
                    Session::flash('old',$post);
                    $msg = "Failed to upload book image";
                    Messages::setMsg($msg, 'error');
                    header('Location: '.base_url('book/add'));
                    return false;
                }
            }

            if(isset($_FILES['book_doc'])){
                $bookDoc  = $this->upload($_FILES['book_doc'],'documents');

                if(!$bookDoc){
                    Session::flash('old',$post);
                    $msg = "Failed to upload book document";
                    Messages::setMsg($msg, 'error');
                    header('Location: '.base_url('book/add'));
                    return false;
                }
            }


            $userID = Session::get('userDetails')['id'];
            // Insert into MySQL
            $this->query('INSERT INTO books(title, author, visibility, user_id, image_path,book_path) VALUES(:title, :author, :visibility, :user_id, :image_path, :book_path)');
            $this->bind(':title', $post['title']);
            $this->bind(':author', $post['author']);
            $this->bind(':visibility', $post['visibility']);
            $this->bind(':user_id', $userID);
            $this->bind(':image_path', $bookImage);
            $this->bind(':book_path', $bookDoc);
            $this->execute();

            // Verify
            if($this->lastInsertId()){
                Messages::setMsg('<strong>Successfully !</strong> Your book has been uploaded on the store.', 'success');
                // Redirect
                header('Location: '.base_url());
                return;
            }
        }
    }

    public function loadMore($offset=1){
        global  $appConfig;
        $offset = $offset * $appConfig['itemsPerPage'];
        $limit = $appConfig['itemsPerPage'];
        //$this->query('SELECT * FROM books ORDER BY id DESC LIMIT :offset,:limit');
        $this->getBooks();
        $this->bind(':offset', $offset);
        $this->bind(':limit', $limit);
        $rows= $this->resultSet();
        return $rows;
    }

    public function search($term='',$offset=0){
        global  $appConfig;
        $offset = $offset * $appConfig['itemsPerPage'];
        $limit = $appConfig['itemsPerPage'];

        if( !Session::get('isLoggedIn') ){
            $this->query("SELECT * FROM books 
                WHERE visibility = 1 AND  title LIKE CONCAT('%', :term, '%')      
                ORDER BY id DESC LIMIT :offset, :limit"
            );
        }else{
            $this->query("SELECT * FROM books 
                WHERE (user_id = :userID AND visibility = 0 AND title LIKE CONCAT('%', :term, '%')) 
                OR ( visibility = 1 AND title LIKE CONCAT('%', :term, '%'))        
                ORDER BY id DESC LIMIT :offset, :limit"
            );
            $this->bind(':userID', Session::get('userDetails')['id']);
        }

        //$this->query("SELECT * FROM books where title LIKE CONCAT('%', :term, '%') ORDER BY id DESC LIMIT :offset,:limit");
        $this->bind(':term', $term);
        $this->bind(':offset', $offset);
        $this->bind(':limit', $limit);
        $rows= $this->resultSet();
        return $rows;
    }

    private function upload($file,$destination){
        error_reporting(E_ALL);
        $fileInfo = pathinfo($file['name']);
        //$filename = $file['name'];
        //$fileNameCmps = explode(".", $filename);
        //$fileExtension = strtolower(end($fileNameCmps));
        $fileExtension = strtolower($fileInfo['extension']);
        $newFileName =   $fileInfo['filename'] .'_'.time(). '.' . $fileExtension;
        $basePath = "$destination/".$newFileName;
        $target = "storage/$basePath";

        if (move_uploaded_file($file['tmp_name'], $target)) {
            return $basePath;
        }else{
            return false;
        }
    }

}