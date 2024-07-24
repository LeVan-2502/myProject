<?php

class GioHangController
{
    public $modelGioHang;
    public $modelChiTietGioHang;
    public function __construct()
    {
        $this->modelGioHang = new GioHang();
    }
    public function listGioHang()
    {
    
        $user_id = $_SESSION['admin']['id'];
       
        // Lấy giỏ hàng từ cơ sở dữ liệu
        $id = $this->modelGioHang->getCartID($user_id);
        $listSPGioHang = $this->modelGioHang->getSanPhamGioHangUser($id);
        
        if (!isset($_SESSION['cart'])) {
            // Nếu giỏ hàng chưa được lưu trong session, lấy từ cơ sở dữ liệu
            $listSPGioHang = $this->modelGioHang->getSanPhamGioHangUser($id);
            $_SESSION['cart'] =$listSPGioHang;
        } else {
            // Nếu giỏ hàng đã có trong session, sử dụng giỏ hàng trong session
            $listSPGioHang = $_SESSION['cart'];
        }


        // Đếm số lượng sản phẩm trong giỏ hàng
        $countSP = count($listSPGioHang);

        // Hiển thị giỏ hàng
        require_once './views/giohang/listgiohang.php';
    }

    public function themGioHang()
    {
        // Kiểm tra xem có sản phẩm với id kia không
        $san_pham_id = $_GET['san_pham_id'] ?? null; // Gán giá trị mặc định là null nếu không có
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $so_luong = $_POST['so_luong']; // Gán mặc định số lượng là 1 nếu không có giá trị
        }else{
            $so_luong = $_GET['so_luong'] ?? 1;
        }
        // Kiểm tra id sản phẩm
        if (!$san_pham_id) {
            echo 'Sản phẩm không được chỉ định.';
            return; // Kết thúc hàm nếu không có sản phẩm ID
        }

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sanpham = $this->modelGioHang->showOneSanPham($san_pham_id);

        if (empty($sanpham)) {
            echo '404 Not Found';
            return; // Kết thúc hàm nếu sản phẩm không tồn tại
        }

        // Lấy thông tin giỏ hàng của người dùng
        $cartItem = $this->modelGioHang->getCartByUserID($_SESSION['admin']['id']);
        $gio_hang_id = $cartItem['id'];

        // Lưu ID giỏ hàng vào session
        $_SESSION['gio_hang_id'] = $gio_hang_id;

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (!isset($_SESSION['cart'][$san_pham_id])) {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm vào giỏ
            $_SESSION['cart'][$san_pham_id] = $sanpham;
            $_SESSION['cart'][$san_pham_id]['so_luong'] = $so_luong;

            // Thêm sản phẩm vào cơ sở dữ liệu
            $this->modelGioHang->insertCartItem($gio_hang_id, $san_pham_id, $so_luong);
        } else {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $qty = $_SESSION['cart'][$san_pham_id]['so_luong'] + $so_luong;
            $_SESSION['cart'][$san_pham_id]['so_luong'] = $qty;

            // Cập nhật số lượng trong cơ sở dữ liệu
            $this->modelGioHang->updateSoLuongSanPhamGioHang($gio_hang_id, $san_pham_id, $qty);
        }


        // Chuyển hướng đến trang giỏ hàng
        header('Location: ' . BASE_URL . '?act=list-giohang');
        exit(); // Kết thúc script để đảm bảo chuyển hướng hoạt động đúng
    }



    public function xacthuc()
    {

        require_once './views/nguoidung/home.php';
    }



    public function xoaGioHang()
    {
        $user_id = $_SESSION['admin']['id'];

        // Lấy giỏ hàng từ cơ sở dữ liệu
        $gio_hang_id = $this->modelGioHang->getCartID($user_id);
        $san_pham_id = $_GET['san_pham_id'];

        $sanpham = $this->modelGioHang->showOneSanPham($san_pham_id);
        if (empty($sanpham)) {
            debug('404 Not Found');
        }
        // Xóa bản ghi trong ssesion và chitietdonhang

        if (isset($_SESSION['cart'][$san_pham_id])) {
            unset($_SESSION['cart'][$san_pham_id]);
        }

        $this->modelGioHang->deleteSanPhamGioHang($gio_hang_id, $san_pham_id);
        header('Location:' . BASE_URL . '?act=list-giohang');
        exit();
    }
    public function capNhatGioHang()
    {
        if (isset($_POST['update_cart'])) {
            $ids = $_POST['id'];

            $quantities = $_POST['so_luong'];
            $user_id = $_SESSION['admin']['id'];
            $gio_hang_id = $this->modelGioHang->getCartID($user_id);

            for ($i = 0; $i < count($ids); $i++) {
                $id = $ids[$i];

                $so_luong = $quantities[$i];

                // Cập nhật số lượng trong SESSION
                if (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['so_luong'] = $so_luong;
                }

                $this->modelGioHang->capNhatSanPhamGioHang($id, $so_luong);
            }

            // Điều hướng người dùng trở lại trang giỏ hàng
            header('Location: ' . BASE_URL . '?act=list-giohang');
            exit();
        }
    }
    public function capNhatGioHangOne()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $san_pham_id = $_POST['id'];
            $so_luong = $_POST['so_luong'];
            $gio_hang_id = $_SESSION['gio_hang_id'];


            $sanpham = $this->modelGioHang->showOneSanPham($san_pham_id);
            // Cập nhật số lượng trong SESSION
            if (!isset($_SESSION['cart'][$san_pham_id])) {
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm vào giỏ
                $_SESSION['cart'][$san_pham_id] = $sanpham;
                $_SESSION['cart'][$san_pham_id]['so_luong'] = $so_luong;

                // Thêm sản phẩm vào cơ sở dữ liệu
                $this->modelGioHang->insertCartItem($gio_hang_id, $san_pham_id, $so_luong);
            } else {
                // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                $qty = $_SESSION['cart'][$san_pham_id]['so_luong'] + $so_luong;
                $this->modelGioHang->updateSoLuongSanPhamGioHang($gio_hang_id, $san_pham_id, $qty);
            }
            // Cập nhật số lượng trong CSDL



            // Điều hướng người dùng trở lại trang giỏ hàng
            header('Location: ' . BASE_URL . '?act=list-giohang');
            exit();
        }
    }
    public function formCheckoutGioHang()

    {
        if (isset($_SESSION['admin']) && isset($_SESSION['admin']['id'])) {
            $tai_khoan_id = $_SESSION['admin']['id'];
        } else {
            $tai_khoan_id = null;
        }
        $to_tal = $_SESSION['to_tal'];
        $listPhuongThuc = $this->modelGioHang->getAllPhuongThuc();
        $id = $this->modelGioHang->getCartID($_SESSION['admin']['id']);
        $listSPGioHang = $_SESSION['cart'];
        require_once './views/giohang/checkout.php';
        unset($_SESSION['errors']);
    }

    public function checkoutOnlineSuccess(){
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                if ($_POST['phuong_thuc_thanh_toan_id'] == 2) {
                    if (isset($_SESSION['admin'])) {
                        $admin = $_SESSION['admin'];
                    }
                    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl ="http://localhost/woodyshop/?act=myaccount&id_tai_khoan=" . $admin['id'];
                    $vnp_TmnCode = "KERDPTBW"; //Mã website tại VNPAY 
                    $vnp_HashSecret = "89AMM3IZSBG8RG0KLLSBA5TWY08URP80"; //Chuỗi bí mật
    
                    $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
                    $vnp_OrderInfo = "noi dung thanh toan";
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = 10000 * 100;
                    $vnp_Locale = 'vn';
                    $vnp_BankCode = $_POST['bank_code'];
                    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                    //Add Params of 2.0.1 Version
                    $vnp_ExpireDate = $_POST['txtexpire'];
                    //Billing
                    // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
                    // $vnp_Bill_Email = $_POST['txt_billing_email'];
                    // $fullName = trim($_POST['txt_billing_fullname']);
                    // if (isset($fullName) && trim($fullName) != '') {
                    //     $name = explode(' ', $fullName);
                    //     $vnp_Bill_FirstName = array_shift($name);
                    //     $vnp_Bill_LastName = array_pop($name);
                    // }
                    // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
                    // $vnp_Bill_City = $_POST['txt_bill_city'];
                    // $vnp_Bill_Country = $_POST['txt_bill_country'];
                    // $vnp_Bill_State = $_POST['txt_bill_state'];
                    // // Invoice
                    // $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
                    // $vnp_Inv_Email = $_POST['txt_inv_email'];
                    // $vnp_Inv_Customer = $_POST['txt_inv_customer'];
                    // $vnp_Inv_Address = $_POST['txt_inv_addr1'];
                    // $vnp_Inv_Company = $_POST['txt_inv_company'];
                    // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
                    // $vnp_Inv_Type = $_POST['cbo_inv_type'];
                    $inputData = array(
                        "vnp_Version" => "2.1.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
    
    
                        // "vnp_ExpireDate" => $vnp_ExpireDate,
                        // // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                        // "vnp_Bill_Email" => $vnp_Bill_Email,
                        // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
                        // "vnp_Bill_LastName" => $vnp_Bill_LastName,
                        // "vnp_Bill_Address" => $vnp_Bill_Address,
                        // "vnp_Bill_City" => $vnp_Bill_City,
                        // "vnp_Bill_Country" => $vnp_Bill_Country,
                        // "vnp_Inv_Phone" => $vnp_Inv_Phone,
                        // "vnp_Inv_Email" => $vnp_Inv_Email,
                        // "vnp_Inv_Customer" => $vnp_Inv_Customer,
                        // "vnp_Inv_Address" => $vnp_Inv_Address,
                        // "vnp_Inv_Company" => $vnp_Inv_Company,
                        // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
                        // "vnp_Inv_Type" => $vnp_Inv_Type
                    );
    
                    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                        $inputData['vnp_BankCode'] = $vnp_BankCode;
                    }
                    // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                    //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
                    // }
    
                    //var_dump($inputData);
                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                        } else {
                            $hashdata .= urlencode($key) . "=" . urlencode($value);
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }
    
                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                    }
                    $returnData = array(
                        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                    );
                    if (isset($_POST['redirect'])) {
                        header('Location: ' . $vnp_Url);
                        die();
                    } else {
                        echo json_encode($returnData);
                    }
                }
    
                // Lấy dữ liệu từ POST request và kiểm tra tính hợp lệ
                $tai_khoan_id = $_SESSION['admin']['id'];
                $tong_tien = $_POST['tong_tien'] ?? null;
                $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? null;
                $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? null;
                $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? null;
                $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? null;
                $ngay_dat = $_POST['ngay_dat'] ?? null;
                $ghi_chu = $_POST['ghi_chu'] ?? null;
                $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'] ?? null;
                $trang_thai_id = 1; // Mặc định trạng thái đơn hàng là 1 (đã xử lý)
    
                // Kiểm tra và xác thực dữ liệu
                if (isset($_SESSION['admin']) && isset($_SESSION['admin']['id'])) {
                    $tai_khoan_id = $_SESSION['admin']['id'];
                } else {
                    $tai_khoan_id = null;
                }
                $errors = [];
                if (empty($ten_nguoi_nhan)) {
                    $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
                }
                if (empty($email_nguoi_nhan) || !filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
                    $errors['email_nguoi_nhan'] = 'Email người nhận không hợp lệ';
                }
                if (empty($sdt_nguoi_nhan) || !preg_match('/^\d{10,11}$/', $sdt_nguoi_nhan)) {
                    $errors['sdt_nguoi_nhan'] = 'Số điện thoại không hợp lệ';
                }
                if (empty($dia_chi_nguoi_nhan)) {
                    $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
                }
                if (empty($ngay_dat) || !DateTime::createFromFormat('Y-m-d', $ngay_dat)) {
                    $errors['ngay_dat'] = 'Ngày đặt không hợp lệ';
                }
    
                if (empty($phuong_thuc_thanh_toan_id)) {
                    $errors['phuong_thuc_thanh_toan_id'] = 'Phương thức thanh toán không được để trống';
                }
                $_SESSION['errors'] = $errors;
    
                if (!empty($errors)) {
    
                    // Trả lại thông báo lỗi cho người dùng
                    header('Location: ' . BASE_URL . '?act=checkout-giohang');
                    exit();
                }
    
                // Thực hiện chèn đơn hàng vào cơ sở dữ liệu
                $donHangId = $this->modelGioHang->insertDonHang(
                    $tai_khoan_id,
                    $ten_nguoi_nhan,
                    $email_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ngay_dat,
                    $tong_tien,
                    $ghi_chu,
                    $phuong_thuc_thanh_toan_id,
                    $trang_thai_id
                );
    
                // Thực hiện chèn chi tiết đơn hàng
                $gioHang = $_SESSION['cart'];
    
                foreach ($gioHang as $item) {
                    $sanPhamId = $item['id'];
                    $soLuong = $item['so_luong'];
    
                    $donGia = $item['gia_san_pham'];
                    $thanhTien = $soLuong * $donGia;
    
                    $this->modelGioHang->insertChiTietDonHang(
                        $donHangId,
                        $sanPhamId,
                        $donGia,
                        $soLuong,
                        $thanhTien
    
                    );
                }
    
                $user_id = $_SESSION['admin']['id'];
    
                // Lấy giỏ hàng từ cơ sở dữ liệu
                $gio_hang_id = $this->modelGioHang->getCartID($user_id);
                // Xóa giỏ hàng sau khi chèn đơn hàng thành công
                $this->modelGioHang->deleteGioHangDuLieu($gio_hang_id);
                unset($_SESSION['cart']);
                unset($_SESSION['errors']); // Xóa thông báo lỗi nếu có
    
    
                // Chuyển hướng đến trang tài khoản người dùng sau khi chèn đơn hàng thành công
                header('Location: ' . BASE_URL . '?act=myaccount');
                exit();
            }
        
    }
    public function checkoutSuccess()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ POST request và kiểm tra tính hợp lệ
            $tai_khoan_id = $_SESSION['admin']['id'];
            $tong_tien = $_POST['tong_tien'] ?? null;
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? null;
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? null;
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? null;
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? null;
            $ngay_dat = $_POST['ngay_dat'] ?? null;
            $ghi_chu = $_POST['ghi_chu'] ?? null;
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'] ?? null;
            $trang_thai_id = 1; // Mặc định trạng thái đơn hàng là 1 (đã xử lý)

            // Kiểm tra và xác thực dữ liệu
            if (isset($_SESSION['admin']) && isset($_SESSION['admin']['id'])) {
                $tai_khoan_id = $_SESSION['admin']['id'];
            } else {
                $tai_khoan_id = null;
            }
            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan) || !filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
                $errors['email_nguoi_nhan'] = 'Email người nhận không hợp lệ';
            }
            if (empty($sdt_nguoi_nhan) || !preg_match('/^\d{10,11}$/', $sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Số điện thoại không hợp lệ';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }
            if (empty($ngay_dat) || !DateTime::createFromFormat('Y-m-d', $ngay_dat)) {
                $errors['ngay_dat'] = 'Ngày đặt không hợp lệ';
            }

            if (empty($phuong_thuc_thanh_toan_id)) {
                $errors['phuong_thuc_thanh_toan_id'] = 'Phương thức thanh toán không được để trống';
            }
            $_SESSION['errors'] = $errors;

            if (!empty($errors)) {

                // Trả lại thông báo lỗi cho người dùng
                header('Location: ' . BASE_URL . '?act=checkout-giohang');
                exit();
            }

            // Thực hiện chèn đơn hàng vào cơ sở dữ liệu
            $donHangId = $this->modelGioHang->insertDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ngay_dat,
                $tong_tien,
                $ghi_chu,
                $phuong_thuc_thanh_toan_id,
                $trang_thai_id
            );

            // Thực hiện chèn chi tiết đơn hàng
            $gioHang = $_SESSION['cart'];

            foreach ($gioHang as $item) {
                $sanPhamId = $item['id'];
                $soLuong = $item['so_luong'];

                $donGia = $item['gia_san_pham'];
                $thanhTien = $soLuong * $donGia;

                $this->modelGioHang->insertChiTietDonHang(
                    $donHangId,
                    $sanPhamId,
                    $donGia,
                    $soLuong,
                    $thanhTien

                );
            }

            $user_id = $_SESSION['admin']['id'];

            // Lấy giỏ hàng từ cơ sở dữ liệu
            $gio_hang_id = $this->modelGioHang->getCartID($user_id);
            // Xóa giỏ hàng sau khi chèn đơn hàng thành công
            $this->modelGioHang->deleteGioHangDuLieu($gio_hang_id);
            unset($_SESSION['cart']);
            unset($_SESSION['errors']); // Xóa thông báo lỗi nếu có


            // Chuyển hướng đến trang tài khoản người dùng sau khi chèn đơn hàng thành công
            header('Location: ' . BASE_URL . '?act=myaccount');
            exit();
        }
    }

    // public function deleteItemLichSuDonHang(){
    //     $id = $_GET['id_don_hang'];
    //     $this->modelGioHang->deleteSanPhamGioHang($id);
    // }
    
    function debug($e)
    {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
        die();
    }
}
