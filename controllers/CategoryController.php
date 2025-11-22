<?php

class CategoryController {
    
    public function index() {
        $page = 'categories';
        $title = 'Quản Lý Danh Mục - Quản lý Quán Cà Phê';
        $header = 'Quản Lý Danh Mục Sản Phẩm';
        
        // Sample category data with hierarchical structure (in real app, this would come from models)
        $categories = [
            ['id' => 1, 'name' => 'Đồ uống', 'description' => 'Tất cả các loại đồ uống', 'parent_id' => null, 'status' => 'active'],
            ['id' => 2, 'name' => 'Cà phê', 'description' => 'Các loại cà phê', 'parent_id' => 1, 'status' => 'active'],
            ['id' => 3, 'name' => 'Trà', 'description' => 'Các loại trà', 'parent_id' => 1, 'status' => 'active'],
            ['id' => 4, 'name' => 'Trà sữa', 'description' => 'Các loại trà sữa', 'parent_id' => 1, 'status' => 'active'],
            ['id' => 5, 'name' => 'Sinh tố', 'description' => 'Các loại sinh tố hoa quả', 'parent_id' => 1, 'status' => 'active'],
            ['id' => 6, 'name' => 'Đồ ăn', 'description' => 'Tất cả các loại đồ ăn', 'parent_id' => null, 'status' => 'active'],
            ['id' => 7, 'name' => 'Bánh ngọt', 'description' => 'Các loại bánh ngọt', 'parent_id' => 6, 'status' => 'active'],
            ['id' => 8, 'name' => 'Bánh mặn', 'description' => 'Các loại bánh mặn', 'parent_id' => 6, 'status' => 'inactive'],
            ['id' => 9, 'name' => 'Cà phê đen', 'description' => 'Cà phê đen nguyên chất', 'parent_id' => 2, 'status' => 'active'],
            ['id' => 10, 'name' => 'Cà phê sữa', 'description' => 'Cà phê với sữa', 'parent_id' => 2, 'status' => 'active'],
        ];
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'categories/index.php';
        $content = ob_get_clean();
        
        // Include base layout
        include VIEWS_DIR . 'layouts/base.php';
    }
    
    public function form() {
        $page = 'category-form';
        $title = 'Thêm/Sửa Danh Mục - Quản lý Quán Cà Phê';
        
        // Get category ID if editing
        $categoryId = isset($_GET['id']) ? intval($_GET['id']) : null;
        
        // Sample categories for parent dropdown
        $categories = [
            ['id' => 1, 'name' => 'Đồ uống', 'parent_id' => null],
            ['id' => 2, 'name' => 'Cà phê', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Trà', 'parent_id' => 1],
            ['id' => 4, 'name' => 'Trà sữa', 'parent_id' => 1],
            ['id' => 5, 'name' => 'Sinh tố', 'parent_id' => 1],
            ['id' => 6, 'name' => 'Đồ ăn', 'parent_id' => null],
            ['id' => 7, 'name' => 'Bánh ngọt', 'parent_id' => 6],
            ['id' => 8, 'name' => 'Bánh mặn', 'parent_id' => 6],
        ];
        
        // If editing, get the category data
        $category = null;
        if ($categoryId) {
            // In real app, this would fetch from database
            $allCategories = [
                ['id' => 1, 'name' => 'Đồ uống', 'description' => 'Tất cả các loại đồ uống', 'parent_id' => null, 'status' => 'active'],
                ['id' => 2, 'name' => 'Cà phê', 'description' => 'Các loại cà phê', 'parent_id' => 1, 'status' => 'active'],
                ['id' => 3, 'name' => 'Trà', 'description' => 'Các loại trà', 'parent_id' => 1, 'status' => 'active'],
                ['id' => 4, 'name' => 'Trà sữa', 'description' => 'Các loại trà sữa', 'parent_id' => 1, 'status' => 'active'],
                ['id' => 5, 'name' => 'Sinh tố', 'description' => 'Các loại sinh tố hoa quả', 'parent_id' => 1, 'status' => 'active'],
                ['id' => 6, 'name' => 'Đồ ăn', 'description' => 'Tất cả các loại đồ ăn', 'parent_id' => null, 'status' => 'active'],
                ['id' => 7, 'name' => 'Bánh ngọt', 'description' => 'Các loại bánh ngọt', 'parent_id' => 6, 'status' => 'active'],
                ['id' => 8, 'name' => 'Bánh mặn', 'description' => 'Các loại bánh mặn', 'parent_id' => 6, 'status' => 'inactive'],
            ];
            
            foreach ($allCategories as $cat) {
                if ($cat['id'] == $categoryId) {
                    $category = $cat;
                    break;
                }
            }
        }
        
        $header = $category ? 'Sửa Danh Mục: ' . $category['name'] : 'Thêm Danh Mục Mới';
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'categories/form.php';
        $content = ob_get_clean();
        
        // Include base layout
        include VIEWS_DIR . 'layouts/base.php';
    }
}
?>
