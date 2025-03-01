<?php 
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ListSanPhamController.php';
require_once './controllers/ChiTietSanPhamController.php';
require_once './controllers/XacThucController.php';
require_once './controllers/TaiKhoanController.php';
require_once './controllers/GioHangController.php';
require_once './controllers/OnlineCheckoutController.php';
require_once './controllers/BaiVietController.php';
require_once './controllers/QuenMatKhauController.php';

// Require toàn bộ file Models
require_once './models/Home.php';
require_once './models/SanPham.php';
require_once './models/ListSanPham.php';
require_once './models/ChiTietSanPham.php';
require_once './models/XacThuc.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/ChiTietGioHang.php';
require_once './models/OnlineCheckout.php';
require_once './models/BaiViet.php';
require_once './models/QuenMatKhau.php';


// Route
$act = $_GET['act'] ?? '/';

// match function to handle routing
match ($act) {
    // Trang chủ
    '/' => (new HomeController())->homeXem(),

    'listsanpham' => (new ListSanPhamController())->listSanPham(),
    'chitietsanpham' => (new ChiTietSanPhamController())->chiTietSanPham(),

    'dangnhap' => (new XacThucController())->formLogin(),
    'dangxuat' => (new XacThucController())->logout(),
    'xacthuc' => (new HomeController())->xacthuc(),

    'list-nguoixem' => (new ListSanPhamController())->listXem(),
    'locsanpham-caothap' => (new ListSanPhamController())->locSanPhamCaoThap(),
    'locsanpham-thapcao' => (new ListSanPhamController())->locSanPhamThapCao(),
    'locsanpham-moinhat' => (new ListSanPhamController())->locSanPhamMoiNhat(),
    'locsanpham-phobien' => (new ListSanPhamController())->locSanPhamPhoBien(),




    'chitiet-nguoixem' => (new ChiTietSanPhamController())->chiXem(),

    'home-nguoidung' => (new HomeController())->homeDung(),
    

    'myaccount' => (new TaiKhoanController())->taiKhoanCuaToi(),
    'capnhattaikhoan' => (new TaiKhoanController())->formCapNhatTaiKhoan(),
    'post-capnhattaikhoan' => (new TaiKhoanController())->postCapNhatTaiKhoan(),
    'chitiet-donhang' => (new TaiKhoanController())->chiTietDonHang(),

    'form-quen-matkhau' => (new QuenMatKhauController())->quenMatKhau(),
    'post-quen-matkhau' => (new QuenMatKhauController())->postQuenMatKhau(),
    'formdatlai-matkhau' => (new QuenMatKhauController())->datLaiMatKhau(),
    'post-datlai-matkhau' => (new QuenMatKhauController())->postDatLaiMatKhau(),

    'add-giohang' => (new GioHangController())->themGioHang(),
    'list-giohang' => (new GioHangController())->listGioHang(),
    'capnhat-giohang' => (new GioHangController())->capNhatGioHang(),
    'del-giohang' => (new GioHangController())->xoaGioHang(),
    'checkout-giohang' => (new GioHangController())->formCheckoutGioHang(),
    // 'checkout-success' => (new GioHangController())->checkoutOnlineSuccess(),

    'checkout-thank' => (new OnlineCheckoutController())->checkoutThank(),
    'form-thank' => (new OnlineCheckoutController())->formThank(),
    'checkout-success' => (new OnlineCheckoutController())->checkoutOnline(),
    
    'update-giohangtwo' => (new GioHangController())->capNhatGioHangOne(),
    'delete-itemlichsudonhang' => (new GioHangController())->deleteItemLichSuDonHang(),
    'post-binhluan' => (new ChiTietSanPhamController())->postBinhLuan(),

    'baiviet' => (new BaiVietController())->listBaiViet(),
    'chitiet-baiviet' => (new BaiVietController())->chiTietBaiViet(),

};
