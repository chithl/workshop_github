<?php

class AuthController {
    
    public function login() {
        $title = 'Đăng Nhập - Quản lý Quán Cà Phê';
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'auth/login.php';
        $content = ob_get_clean();
        
        // Include auth layout
        include VIEWS_DIR . 'layouts/auth.php';
    }
    
    public function register() {
        $title = 'Đăng Ký - Quản lý Quán Cà Phê';
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'auth/register.php';
        $content = ob_get_clean();
        
        // Include auth layout
        include VIEWS_DIR . 'layouts/auth.php';
    }
}
?>
