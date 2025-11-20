<?php
// Simple router for the admin panel
session_start();

// Get the requested page from URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Define the views directory
define('VIEWS_DIR', __DIR__ . '/views/');

// Load the appropriate controller based on the page
switch ($page) {
    case 'dashboard':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
    
    case 'products':
        require_once 'controllers/ProductController.php';
        $controller = new ProductController();
        $controller->index();
        break;
    
    case 'product-form':
        require_once 'controllers/ProductController.php';
        $controller = new ProductController();
        $controller->form();
        break;
    
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    
    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
    
    default:
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
}
?>
