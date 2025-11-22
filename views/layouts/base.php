<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Quản lý Quán Cà Phê'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-4">
                <h1 class="text-2xl font-bold text-center">
                    <i class="fas fa-coffee"></i> Coffee Shop
                </h1>
            </div>
            <nav class="mt-8">
                <a href="index.php?page=dashboard" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white <?php echo ($page ?? 'dashboard') == 'dashboard' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-chart-line mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="index.php?page=products" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white <?php echo ($page ?? '') == 'products' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-list mr-3"></i>
                    <span>Danh Sách Sản Phẩm</span>
                </a>
                <a href="index.php?page=product-form" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white <?php echo ($page ?? '') == 'product-form' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-plus-circle mr-3"></i>
                    <span>Thêm Sản Phẩm</span>
                </a>
                <a href="index.php?page=categories" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white <?php echo ($page ?? '') == 'categories' || ($page ?? '') == 'category-form' ? 'bg-gray-700 text-white' : ''; ?>">
                    <i class="fas fa-folder-tree mr-3"></i>
                    <span>Quản Lý Danh Mục</span>
                </a>
                <hr class="my-4 border-gray-700">
                <a href="index.php?page=login" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-sign-in-alt mr-3"></i>
                    <span>Đăng Nhập</span>
                </a>
                <a href="index.php?page=register" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-user-plus mr-3"></i>
                    <span>Đăng Ký</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-md">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        <?php echo isset($header) ? $header : 'Dashboard'; ?>
                    </h2>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <div class="flex items-center">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" alt="Avatar" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <?php echo $content; ?>
            </main>
        </div>
    </div>
</body>
</html>
