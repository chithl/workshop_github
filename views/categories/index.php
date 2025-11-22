<!-- 
    TEMPLATE MODE: This page uses sample data and simulated functionality.
    For production implementation with real API integration, see:
    - docs/CATEGORY_API.md for API specification
    - docs/CATEGORY_INTEGRATION_GUIDE.md for integration instructions
-->

<!-- Actions Bar -->
<div class="bg-white rounded-lg shadow-md p-4 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
        <div class="flex items-center space-x-2">
            <input type="text" id="searchInput" placeholder="Tìm kiếm danh mục..." 
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <button onclick="searchCategories()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <i class="fas fa-search"></i> Tìm
            </button>
        </div>
        <div class="flex items-center space-x-2">
            <select id="statusFilter" onchange="filterByStatus()" 
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Tất cả trạng thái</option>
                <option value="active">Hoạt động</option>
                <option value="inactive">Không hoạt động</option>
            </select>
            <button onclick="sortCategories()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                <i class="fas fa-sort"></i> Sắp xếp
            </button>
            <a href="index.php?page=category-form" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus"></i> Thêm Danh Mục
            </a>
        </div>
    </div>
</div>

<!-- Categories Table -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tên Danh Mục
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Mô Tả
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Danh Mục Cha
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Trạng Thái
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao Tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="categoryTableBody">
                <?php
                // Function to build category tree
                function buildCategoryTree($categories, $parentId = null, $level = 0) {
                    foreach ($categories as $category) {
                        if ($category['parent_id'] == $parentId) {
                            $indent = str_repeat('—', $level);
                            // Use predefined Tailwind classes for indentation
                            $indentClasses = ['', 'pl-4', 'pl-8', 'pl-12', 'pl-16'];
                            $indentClass = $level < count($indentClasses) ? $indentClasses[$level] : 'pl-16';
                            ?>
                            <tr class="hover:bg-gray-50 category-row" 
                                data-status="<?php echo $category['status']; ?>" 
                                data-name="<?php echo strtolower($category['name']); ?>"
                                data-id="<?php echo $category['id']; ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo $category['id']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center <?php echo $indentClass; ?>">
                                        <?php if ($level > 0): ?>
                                            <span class="text-gray-400 mr-2"><?php echo $indent; ?></span>
                                        <?php endif; ?>
                                        <?php if ($level == 0): ?>
                                            <i class="fas fa-folder text-indigo-600 mr-2"></i>
                                        <?php else: ?>
                                            <i class="fas fa-folder-open text-blue-500 mr-2"></i>
                                        <?php endif; ?>
                                        <div class="text-sm font-medium text-gray-900"><?php echo $category['name']; ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?php echo $category['description']; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php 
                                    if ($category['parent_id']) {
                                        // Find parent name
                                        foreach ($categories as $parent) {
                                            if ($parent['id'] == $category['parent_id']) {
                                                echo $parent['name'];
                                                break;
                                            }
                                        }
                                    } else {
                                        echo '<span class="text-gray-400">—</span>';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($category['status'] == 'active'): ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Hoạt động
                                        </span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i> Không hoạt động
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="index.php?page=category-form&id=<?php echo $category['id']; ?>" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-3">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button onclick="deleteCategory(<?php echo $category['id']; ?>)" 
                                        class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </td>
                            </tr>
                            <?php
                            // Recursively display child categories
                            buildCategoryTree($categories, $category['id'], $level + 1);
                        }
                    }
                }
                
                // Display the tree starting from root categories (parent_id = null)
                buildCategoryTree($categories);
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Empty State -->
    <div id="emptyState" class="hidden text-center py-12">
        <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
        <p class="text-gray-500 text-lg">Không tìm thấy danh mục nào</p>
    </div>
    
    <!-- Loading State -->
    <div id="loadingState" class="hidden text-center py-12">
        <i class="fas fa-spinner fa-spin text-4xl text-indigo-600 mb-4"></i>
        <p class="text-gray-500">Đang tải dữ liệu...</p>
    </div>
    
    <!-- Pagination -->
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Trước
            </button>
            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Sau
            </button>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Hiển thị <span class="font-medium" id="showingFrom">1</span> đến 
                    <span class="font-medium" id="showingTo"><?php echo count($categories); ?></span> trong số 
                    <span class="font-medium" id="totalItems"><?php echo count($categories); ?></span> danh mục
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" id="pagination">
                    <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-indigo-50 text-sm font-medium text-indigo-600">
                        1
                    </button>
                    <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
function searchCategories() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.category-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const name = row.getAttribute('data-name');
        if (name.includes(searchTerm)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    updateEmptyState(visibleCount);
    updatePaginationInfo(visibleCount);
}

// Filter by status
function filterByStatus() {
    const status = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.category-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        if (status === '' || rowStatus === status) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    updateEmptyState(visibleCount);
    updatePaginationInfo(visibleCount);
}

// Sort categories
// NOTE: This is template code. In production, implement tree-aware sorting that maintains hierarchy
let sortOrder = 'asc';
function sortCategories() {
    alert('🚧 DEMO MODE: Chức năng sắp xếp đang được phát triển.\n\nĐể triển khai, vui lòng xem docs/CATEGORY_INTEGRATION_GUIDE.md');
    // TODO: Implement tree-aware sorting that maintains parent-child relationships
    // For now, we disable this to prevent breaking the tree structure
    return;
    
    /* Original sorting code - disabled to preserve tree structure
    const tbody = document.getElementById('categoryTableBody');
    const rows = Array.from(tbody.querySelectorAll('.category-row'));
    
    rows.sort((a, b) => {
        const nameA = a.getAttribute('data-name');
        const nameB = b.getAttribute('data-name');
        
        if (sortOrder === 'asc') {
            return nameA.localeCompare(nameB);
        } else {
            return nameB.localeCompare(nameA);
        }
    });
    
    rows.forEach(row => tbody.appendChild(row));
    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
    */
}

// Delete category
// NOTE: This is template code. For production implementation, see docs/CATEGORY_INTEGRATION_GUIDE.md
function deleteCategory(id) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
        // DEMO MODE: Show alert instead of actual deletion
        alert('🚧 DEMO MODE: Xóa danh mục ID: ' + id + '\n\nĐể kết nối API thực tế, xem docs/CATEGORY_INTEGRATION_GUIDE.md');
        
        // Production implementation:
        // fetch('/api/categories/' + id, { method: 'DELETE' })
        //     .then(response => response.json())
        //     .then(data => {
        //         if (data.success) {
        //             alert('Xóa danh mục thành công!');
        //             window.location.reload();
        //         } else {
        //             alert('Lỗi: ' + (data.message || 'Không thể xóa danh mục'));
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //         alert('Có lỗi xảy ra khi xóa danh mục');
        //     });
    }
}

// Update empty state
function updateEmptyState(visibleCount) {
    const emptyState = document.getElementById('emptyState');
    const tableBody = document.getElementById('categoryTableBody');
    
    if (visibleCount === 0) {
        tableBody.style.display = 'none';
        emptyState.classList.remove('hidden');
    } else {
        tableBody.style.display = '';
        emptyState.classList.add('hidden');
    }
}

// Update pagination info
function updatePaginationInfo(visibleCount) {
    document.getElementById('showingTo').textContent = visibleCount;
    document.getElementById('totalItems').textContent = visibleCount;
}

// Search on Enter key
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchCategories();
    }
});

// Show loading state example
function showLoading() {
    document.getElementById('loadingState').classList.remove('hidden');
    document.getElementById('categoryTableBody').style.display = 'none';
}

function hideLoading() {
    document.getElementById('loadingState').classList.add('hidden');
    document.getElementById('categoryTableBody').style.display = '';
}
</script>
