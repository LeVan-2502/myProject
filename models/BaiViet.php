<?php
class BaiViet
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
}