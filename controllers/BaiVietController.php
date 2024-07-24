<?php 

class BaiVietController
{
    public $modelBaiViet;
    public function __construct()
    {
        $this->modelBaiViet= new BaiViet();
    }
    public function blog(){
        require_once './views/nguoidung/blog.php';
    }
}