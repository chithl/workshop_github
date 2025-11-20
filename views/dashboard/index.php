<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Sales -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tổng Doanh Thu</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo number_format($stats['total_sales']); ?>đ</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-dollar-sign text-green-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-green-600 mt-2">
            <i class="fas fa-arrow-up"></i> 12% so với tháng trước
        </p>
    </div>

    <!-- Total Orders -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tổng Đơn Hàng</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total_orders']; ?></p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-shopping-cart text-blue-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-blue-600 mt-2">
            <i class="fas fa-arrow-up"></i> 8% so với tháng trước
        </p>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tổng Sản Phẩm</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total_products']; ?></p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-box text-purple-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-purple-600 mt-2">
            <i class="fas fa-arrow-up"></i> 3 sản phẩm mới
        </p>
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Tổng Khách Hàng</p>
                <p class="text-2xl font-bold text-gray-800"><?php echo $stats['total_customers']; ?></p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full">
                <i class="fas fa-users text-orange-600 text-2xl"></i>
            </div>
        </div>
        <p class="text-sm text-orange-600 mt-2">
            <i class="fas fa-arrow-up"></i> 15 khách hàng mới
        </p>
    </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Sales Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Doanh Thu Theo Tháng</h3>
        <canvas id="salesChart"></canvas>
    </div>

    <!-- Products Chart -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sản Phẩm Bán Chạy</h3>
        <canvas id="productsChart"></canvas>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="bg-white rounded-lg shadow-md p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Đơn Hàng Gần Đây</h3>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã Đơn</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sản Phẩm</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Tiền</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng Thái</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#001</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Nguyễn Văn A</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cà phê sữa x2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">60,000đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hoàn thành
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#002</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Trần Thị B</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Cappuccino x1</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">45,000đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Đang xử lý
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#003</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Lê Văn C</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Trà sữa x3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">105,000đ</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hoàn thành
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6'],
            datasets: [{
                label: 'Doanh Thu (VNĐ)',
                data: [12000000, 13500000, 11000000, 14200000, 13800000, 15420000],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + 'đ';
                        }
                    }
                }
            }
        }
    });

    // Products Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    new Chart(productsCtx, {
        type: 'bar',
        data: {
            labels: ['Cà phê đen', 'Cà phê sữa', 'Cappuccino', 'Latte', 'Trà sữa'],
            datasets: [{
                label: 'Số lượng bán',
                data: [85, 120, 65, 78, 95],
                backgroundColor: [
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(139, 92, 246, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
