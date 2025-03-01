<?php

class QuenMatKhauController
{
    public $modelQuenMatKhau;
    public function __construct()
    {
        $this->modelQuenMatKhau = new QuenMatKhau();
    }
    public function quenMatKhau()
    {
        require_once './views/datlaimatkhau/quenmatkhau.php';
    }
    public function postQuenMatKhau()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Xử lý email để tránh lỗi
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email không hợp lệ.";
                return;
            }

            $check = $this->modelQuenMatKhau->getEmailQuenMatKhau($email);

            if ($check) {
                $token = bin2hex(random_bytes(50));
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $thoi_gian_het_han = date("Y-m-d H:i:s", strtotime('+30 minutes'));

                $this->modelQuenMatKhau->deleteTokenMatKhau($email);
                // Xóa token cũ nếu có
                $this->modelQuenMatKhau->insertTokenMatKhau($email, $token, $thoi_gian_het_han); // Chèn token mới vào bảng
                // Gửi email đặt lại mật khẩu
                $reset_link = BASE_URL . '?act=formdatlai-matkhau&token=' . $token;
                $to = $email;
                $subject = "Yêu cầu đặt lại mật khẩu";
                $message = "Nhấp vào liên kết sau để đặt lại mật khẩu của bạn: " . $reset_link;
                $headers = "From: no-reply@woody.com\r\n";
                $headers .= "Reply-To: no-reply@woody.com\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                if (mail($to, $subject, $message, $headers)) {
                    echo "Email đặt lại mật khẩu đã được gửi!";
                } else {
                    echo "Đã xảy ra lỗi khi gửi email. Vui lòng thử lại.";
                }
            } else {
                echo "Email không tồn tại.";
            }
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    public function datLaiMatKhau()
    {

        $token = $_GET['token'];
        require_once './views/datlaimatkhau/datlaimatkhau.php';
    }
    public function postDatLaiMatKhau()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $token = $_POST['token'];

            $mat_khau_reset = $_POST['mat_khau_reset'];

            $mat_khau_xacnhan = $_POST['mat_khau_xacnhan'];

            $_SESSION['errors'] = [];   

            // Kiểm tra xem mật khẩu xác nhận có khớp với mật khẩu mới không
            if ($mat_khau_reset != $mat_khau_xacnhan) {
                $_SESSION['errors']['mat_khau'] = "Mật khẩu xác nhận không trùng với mật khẩu đặt lại.";
            }

            // Nếu không có lỗi, kiểm tra token và cập nhật mật khẩu
            if (empty($_SESSION['errors'])) {
                $check = $this->modelQuenMatKhau->xacNhanTokenThoiGianHetHan($token);
                if ($check) {
                    
                    $email = $check['email'];
             
                    // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
                    $mat_khau_reset = password_hash($mat_khau_reset, PASSWORD_BCRYPT);
                    // debug($mat_khau_reset);
                    // Cập nhật mật khẩu và xóa token
                    $this->modelQuenMatKhau->updateMatKhauTaiKhoan($mat_khau_reset,$email);
                    $this->modelQuenMatKhau->deleteTokenMatKhau($email);

                    echo "Mật khẩu của bạn đã được cập nhật thành công!";
                } else {
                    echo "Token không hợp lệ hoặc đã hết hạn.";
                }
            } else {
                // Hiển thị lỗi cho người dùng
                foreach ($_SESSION['error'] as $error) {
                    echo $error . "<br>";
                }
            }
        }
    }
}
