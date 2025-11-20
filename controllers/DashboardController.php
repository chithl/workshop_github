<?php

class DashboardController {
    
    public function index() {
        $page = 'dashboard';
        $title = 'Dashboard - Quản lý Quán Cà Phê';
        $header = 'Dashboard';
        
        // Get dashboard data (in real app, this would come from models)
        $stats = [
            'total_sales' => 15420000,
            'total_orders' => 234,
            'total_products' => 45,
            'total_customers' => 189
        ];
        
        // Start output buffering for content
        ob_start();
        include VIEWS_DIR . 'dashboard/index.php';
        $content = ob_get_clean();
        
        // Include base layout
        include VIEWS_DIR . 'layouts/base.php';
    }
}
?>
