<!-- 
    TEMPLATE MODE: This form uses simulated submission and validation.
    For production implementation with real API integration, see:
    - docs/CATEGORY_API.md for API specification
    - docs/CATEGORY_INTEGRATION_GUIDE.md for integration instructions
-->

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="#" method="POST" id="categoryForm" onsubmit="return validateForm(event)">
            <!-- Hidden ID field for editing -->
            <?php if ($category): ?>
                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
            <?php endif; ?>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category Name -->
                <div class="md:col-span-2">
                    <label for="category_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Tên Danh Mục <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="category_name" name="category_name" required
                        value="<?php echo $category['name'] ?? ''; ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Nhập tên danh mục">
                    <p id="nameError" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Mô Tả
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="Nhập mô tả danh mục"><?php echo $category['description'] ?? ''; ?></textarea>
                </div>

                <!-- Parent Category -->
                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Danh Mục Cha
                    </label>
                    <select id="parent_id" name="parent_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Không có (Danh mục gốc) --</option>
                        <?php
                        // Function to build category tree for dropdown
                        function buildCategoryOptions($categories, $selectedId = null, $excludeId = null, $parentId = null, $level = 0) {
                            // Get all descendants to exclude
                            $excludeIds = [];
                            if ($excludeId) {
                                $excludeIds = getDescendantIds($categories, $excludeId);
                                $excludeIds[] = $excludeId;
                            }
                            
                            foreach ($categories as $cat) {
                                // Skip the category being edited and its descendants
                                if (in_array($cat['id'], $excludeIds)) {
                                    continue;
                                }
                                
                                if ($cat['parent_id'] == $parentId) {
                                    $indent = str_repeat('—', $level);
                                    $selected = ($selectedId && $cat['id'] == $selectedId) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $indent . ($level > 0 ? ' ' : '') . $cat['name']; ?>
                                    </option>
                                    <?php
                                    // Recursively display child categories
                                    buildCategoryOptions($categories, $selectedId, $excludeId, $cat['id'], $level + 1);
                                }
                            }
                        }
                        
                        // Helper function to get all descendant IDs
                        function getDescendantIds($categories, $parentId) {
                            $descendants = [];
                            foreach ($categories as $cat) {
                                if ($cat['parent_id'] == $parentId) {
                                    $descendants[] = $cat['id'];
                                    // Recursively get descendants
                                    $descendants = array_merge($descendants, getDescendantIds($categories, $cat['id']));
                                }
                            }
                            return $descendants;
                        }
                        
                        // Display parent category options (excluding current category if editing)
                        buildCategoryOptions(
                            $categories, 
                            $category['parent_id'] ?? null, 
                            $category['id'] ?? null
                        );
                        ?>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-info-circle"></i> Chọn danh mục cha để tạo danh mục con. Để trống nếu là danh mục gốc.
                    </p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Trạng Thái <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="active" 
                                <?php echo (!$category || $category['status'] == 'active') ? 'checked' : ''; ?>
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">
                                <i class="fas fa-check-circle text-green-600"></i> Hoạt động
                            </span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="inactive"
                                <?php echo ($category && $category['status'] == 'inactive') ? 'checked' : ''; ?>
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">
                                <i class="fas fa-times-circle text-red-600"></i> Không hoạt động
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Display Order (optional) -->
                <div class="md:col-span-2">
                    <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">
                        Thứ Tự Hiển Thị
                    </label>
                    <input type="number" id="display_order" name="display_order" min="0"
                        value="<?php echo $category['display_order'] ?? 0; ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="0">
                    <p class="mt-1 text-sm text-gray-500">
                        <i class="fas fa-info-circle"></i> Số thứ tự để sắp xếp danh mục (số nhỏ sẽ hiển thị trước)
                    </p>
                </div>
            </div>

            <!-- Form Validation Messages -->
            <div id="errorMessages" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex">
                    <i class="fas fa-exclamation-circle text-red-600 mr-2"></i>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Có lỗi xảy ra:</h3>
                        <ul id="errorList" class="mt-2 text-sm text-red-700 list-disc list-inside"></ul>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="hidden mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    <p class="text-sm text-green-800">Lưu danh mục thành công!</p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                <a href="index.php?page=categories" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-times"></i> Hủy
                </a>
                <button type="reset" class="px-6 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                    <i class="fas fa-redo"></i> Làm Mới
                </button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-save"></i> 
                    <?php echo $category ? 'Cập Nhật' : 'Lưu Danh Mục'; ?>
                </button>
            </div>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h3 class="text-sm font-medium text-blue-900 mb-2">
            <i class="fas fa-info-circle"></i> Hướng Dẫn
        </h3>
        <ul class="text-sm text-blue-800 space-y-1">
            <li><i class="fas fa-check text-blue-600 mr-1"></i> Tên danh mục là bắt buộc và phải là duy nhất trong cùng cấp cha</li>
            <li><i class="fas fa-check text-blue-600 mr-1"></i> Chọn danh mục cha để tạo phân cấp danh mục (ví dụ: "Cà phê" là con của "Đồ uống")</li>
            <li><i class="fas fa-check text-blue-600 mr-1"></i> Danh mục không hoạt động sẽ không hiển thị trên website</li>
            <li><i class="fas fa-check text-blue-600 mr-1"></i> Không thể chọn chính nó hoặc danh mục con của nó làm danh mục cha</li>
        </ul>
    </div>
</div>

<script>
// Form validation
function validateForm(event) {
    event.preventDefault();
    
    const errors = [];
    const categoryName = document.getElementById('category_name').value.trim();
    
    // Clear previous errors
    document.getElementById('errorMessages').classList.add('hidden');
    document.getElementById('errorList').innerHTML = '';
    document.getElementById('nameError').classList.add('hidden');
    
    // Validate category name
    if (categoryName === '') {
        errors.push('Tên danh mục là bắt buộc');
        document.getElementById('nameError').textContent = 'Tên danh mục là bắt buộc';
        document.getElementById('nameError').classList.remove('hidden');
    } else if (categoryName.length < 2) {
        errors.push('Tên danh mục phải có ít nhất 2 ký tự');
        document.getElementById('nameError').textContent = 'Tên danh mục phải có ít nhất 2 ký tự';
        document.getElementById('nameError').classList.remove('hidden');
    } else if (categoryName.length > 100) {
        errors.push('Tên danh mục không được vượt quá 100 ký tự');
        document.getElementById('nameError').textContent = 'Tên danh mục không được vượt quá 100 ký tự';
        document.getElementById('nameError').classList.remove('hidden');
    }
    
    // Check for duplicate name (in real app, this would be an API call)
    // Example: checkDuplicateName(categoryName, parentId);
    
    if (errors.length > 0) {
        displayErrors(errors);
        return false;
    }
    
    // If validation passes, submit the form
    submitForm();
    return false;
}

// Display validation errors
function displayErrors(errors) {
    const errorMessages = document.getElementById('errorMessages');
    const errorList = document.getElementById('errorList');
    
    errorMessages.classList.remove('hidden');
    
    errors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        errorList.appendChild(li);
    });
    
    // Scroll to error messages
    errorMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Submit form
// NOTE: This is template code with simulated API call. For production, see docs/CATEGORY_INTEGRATION_GUIDE.md
function submitForm() {
    const form = document.getElementById('categoryForm');
    const formData = new FormData(form);
    
    // Show loading state
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerHTML;
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lưu...';
    
    // DEMO MODE: Simulate API call with setTimeout
    // For production implementation, replace this with actual API call
    setTimeout(() => {
        // Production implementation (uncomment and configure):
        /*
        const id = formData.get('id');
        const url = id ? '/api/categories/' + id : '/api/categories';
        const method = id ? 'PUT' : 'POST';
        
        // Convert FormData to JSON
        const data = {};
        formData.forEach((value, key) => { data[key] = value; });
        
        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess();
                setTimeout(() => {
                    window.location.href = 'index.php?page=categories';
                }, 1500);
            } else {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
                displayErrors(data.errors || ['Có lỗi xảy ra']);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
            displayErrors(['Có lỗi xảy ra khi lưu danh mục']);
        });
        */
        
        // DEMO: Show success and redirect
        showSuccess();
        submitButton.disabled = false;
        submitButton.innerHTML = originalText;
        
        setTimeout(() => {
            window.location.href = 'index.php?page=categories';
        }, 1500);
    }, 1000);
}

// Show success message
function showSuccess() {
    const successMessage = document.getElementById('successMessage');
    successMessage.classList.remove('hidden');
    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Real-time validation for category name
document.getElementById('category_name').addEventListener('input', function() {
    const value = this.value.trim();
    const errorElement = document.getElementById('nameError');
    
    if (value === '') {
        errorElement.textContent = 'Tên danh mục là bắt buộc';
        errorElement.classList.remove('hidden');
        this.classList.add('border-red-500');
    } else if (value.length < 2) {
        errorElement.textContent = 'Tên danh mục phải có ít nhất 2 ký tự';
        errorElement.classList.remove('hidden');
        this.classList.add('border-red-500');
    } else if (value.length > 100) {
        errorElement.textContent = 'Tên danh mục không được vượt quá 100 ký tự';
        errorElement.classList.remove('hidden');
        this.classList.add('border-red-500');
    } else {
        errorElement.classList.add('hidden');
        this.classList.remove('border-red-500');
    }
});

// Prevent selecting the category being edited as its own parent
<?php if ($category): ?>
const currentCategoryId = <?php echo $category['id']; ?>;
const parentSelect = document.getElementById('parent_id');

parentSelect.addEventListener('change', function() {
    if (parseInt(this.value) === currentCategoryId) {
        alert('Không thể chọn chính danh mục này làm danh mục cha!');
        this.value = '<?php echo $category['parent_id'] ?? ''; ?>';
    }
});
<?php endif; ?>
</script>
