<?php
class BookController extends Controller{
    public function __construct($action, $request)
    {
        parent::__construct($action, $request);
        $this->viewmodel = new BookModel();
    }

    public function index(){
        //$viewmodel = new ShareModel();
        $this->returnView($this->viewmodel->index(), 'home', true);
    }

    public function add(){
        $this->ReturnView(null, 'book', true);
    }

    public function save(){
        $this->viewmodel->add();
    }

    public function loadMore(){
        $params = queryParams();
        $offset = isset($params['offset'])?$params['offset']:1;
        $data = $this->viewmodel->loadMore($offset);
        sleep(1);
        echo json_encode([
            'data'=>array_map(function ($item){
                $item['image_path'] = base_url('storage/').$item['image_path'];
                $item['book_path'] = base_url('storage/').$item['book_path'];
                $item['title'] = ucwords($item['title']);
                $item['author'] = ucwords($item['author']);
                return $item;
            },$data),
            'status'=>true,
            'load_more'=>count($data)<=0?false:true
        ]);
    }


    public function search(){
        $params = queryParams();
        $offset = isset($params['offset'])?$params['offset']:0;
        $term = isset($params['search'])?urldecode($params['search']):'';
        $data = $this->viewmodel->search($term,$offset);
        sleep(1);
        echo json_encode([
            'data'=>array_map(function ($item){
                $item['image_path'] = base_url('storage/').$item['image_path'];
                $item['book_path'] = base_url('storage/').$item['book_path'];
                $item['title'] = ucwords($item['title']);
                $item['author'] = ucwords($item['author']);
                return $item;
            },$data),
            'status'=>true,
            'load_more'=>count($data)<=0?false:true
        ]);
    }
}