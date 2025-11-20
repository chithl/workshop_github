<?php

class ProductController {
    
    public function index() {
        $page = 'products';
        $title = 'Danh Sách Sản Phẩm - Quản lý Quán Cà Phê';
        $header = 'Danh Sách Sản Phẩm';
        
        // Sample product data (in real app, this would come from models)
        $products = [
            ['id' => 1, 'name' => 'Cà phê đen', 'category' => 'Cà phê', 'price' => 25000, 'stock' => 100],
            ['id' => 2, 'name' => 'Cà phê sữa', 'category' => 'Cà phê', 'price' => 30000, 'stock' => 85],
            ['id' => 3, 'name' => 'Cappuccino', 'category' => 'Cà phê', 'price' => 45000, 'stock' => 60],
            ['id' => 4, 'name' => 'Latte', 'category' => 'Cà phê', 'price' => 45000, 'stock' => 75],
            ['id' => 5, 'name' => 'Trà sữa truyền thống', 'category' => 'Trà sữa', 'price' => 35000, 'stock' => 50],
            ['id' => 6, 'name' => 'Trà đào', 'category' => 'Trà', 'price' => 40000, 'stock' => 45],
            ['id' => 7, 'name' => 'Sinh tố bơ', 'category' => 'Sinh tố', 'price' => 42000, 'stock' => 30],
            ['id' => 8, 'name' => 'Bánh croissant', 'category' => 'Bánh', 'price' => 28000, 'stock' => 20],
        ];
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'products/index.php';
        $content = ob_get_clean();
        
        // Include base layout
        include VIEWS_DIR . 'layouts/base.php';
    }
    
    public function form() {
        $page = 'product-form';
        $title = 'Thêm Sản Phẩm - Quản lý Quán Cà Phê';
        $header = 'Thêm Sản Phẩm Mới';
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'products/form.php';
        $content = ob_get_clean();
        
        // Include base layout
        include VIEWS_DIR . 'layouts/base.php';
    }
}
?>
