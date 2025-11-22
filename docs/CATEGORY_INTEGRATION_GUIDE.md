# Hướng Dẫn Tích Hợp - Quản Lý Danh Mục Sản Phẩm

## Tổng quan

Tài liệu này hướng dẫn cách tích hợp và sử dụng giao diện quản lý danh mục sản phẩm trong hệ thống Coffee Shop Admin.

## Cấu trúc Components

### 1. CategoryController.php

**Vị trí**: `/controllers/CategoryController.php`

Controller xử lý logic cho các trang quản lý danh mục.

#### Methods:

- `index()`: Hiển thị danh sách danh mục
- `form()`: Hiển thị form thêm/sửa danh mục

#### Sử dụng:

```php
<?php
require_once 'controllers/CategoryController.php';
$controller = new CategoryController();

// Hiển thị danh sách
$controller->index();

// Hiển thị form (thêm mới hoặc sửa)
$controller->form();
?>
```

### 2. CategoryList View

**Vị trí**: `/views/categories/index.php`

Giao diện hiển thị danh sách danh mục dạng tree.

#### Features:

- ✅ Hiển thị danh mục dạng phân cấp (tree structure)
- ✅ Tìm kiếm theo tên danh mục
- ✅ Filter theo trạng thái (active/inactive)
- ✅ Sắp xếp danh mục
- ✅ Nút sửa/xóa cho mỗi danh mục
- ✅ Pagination
- ✅ Empty state khi không có dữ liệu
- ✅ Loading state

#### Props (Data passed from controller):

```php
$categories = [
    [
        'id' => 1,
        'name' => 'Đồ uống',
        'description' => 'Tất cả các loại đồ uống',
        'parent_id' => null,
        'status' => 'active'
    ],
    // ...
];
```

#### JavaScript Functions:

- `searchCategories()`: Tìm kiếm danh mục
- `filterByStatus()`: Lọc theo trạng thái
- `sortCategories()`: Sắp xếp danh mục
- `deleteCategory(id)`: Xóa danh mục
- `updateEmptyState(count)`: Hiển thị empty state
- `updatePaginationInfo(count)`: Cập nhật thông tin phân trang

### 3. CategoryForm View

**Vị trí**: `/views/categories/form.php`

Giao diện form để thêm mới hoặc sửa danh mục.

#### Features:

- ✅ Form validation (client-side)
- ✅ Dropdown chọn danh mục cha (hierarchical)
- ✅ Chọn trạng thái (active/inactive)
- ✅ Real-time validation
- ✅ Error messages
- ✅ Success messages
- ✅ Prevent self-reference (không thể chọn chính nó làm parent)

#### Props (Data passed from controller):

```php
// For editing
$category = [
    'id' => 2,
    'name' => 'Cà phê',
    'description' => 'Các loại cà phê',
    'parent_id' => 1,
    'status' => 'active',
    'display_order' => 0
];

// List of all categories for parent dropdown
$categories = [...];
```

#### JavaScript Functions:

- `validateForm(event)`: Validate form trước khi submit
- `displayErrors(errors)`: Hiển thị lỗi validation
- `submitForm()`: Submit form (API call)
- `showSuccess()`: Hiển thị thông báo thành công

## Routing

### Routes trong index.php

```php
case 'categories':
    require_once 'controllers/CategoryController.php';
    $controller = new CategoryController();
    $controller->index();
    break;

case 'category-form':
    require_once 'controllers/CategoryController.php';
    $controller = new CategoryController();
    $controller->form();
    break;
```

### URL Structure:

- **Danh sách**: `index.php?page=categories`
- **Thêm mới**: `index.php?page=category-form`
- **Sửa**: `index.php?page=category-form&id={id}`

## API Integration

### Tích hợp với Backend API

Để kết nối với backend API thực tế, cần cập nhật các functions trong view files:

#### 1. Lấy danh sách danh mục

**File**: `CategoryController.php`

```php
public function index() {
    // Replace sample data with API call
    $categories = $this->getCategoriesFromAPI();
    
    // ... rest of the code
}

private function getCategoriesFromAPI() {
    $ch = curl_init('http://localhost/api/categories');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $data = json_decode($response, true);
    return $data['success'] ? $data['data'] : [];
}
```

#### 2. Tạo/Cập nhật danh mục

**File**: `views/categories/form.php` - Update `submitForm()` function:

```javascript
function submitForm() {
    const form = document.getElementById('categoryForm');
    const formData = new FormData(form);
    const id = formData.get('id');
    
    const url = id ? `/api/categories/${id}` : '/api/categories';
    const method = id ? 'PUT' : 'POST';
    
    // Convert FormData to JSON
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
        },
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
            displayErrors(data.errors);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        displayErrors(['Có lỗi xảy ra khi lưu danh mục']);
    });
}
```

#### 3. Xóa danh mục

**File**: `views/categories/index.php` - Update `deleteCategory()` function:

```javascript
function deleteCategory(id) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
        fetch(`/api/categories/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Xóa danh mục thành công!');
                window.location.reload();
            } else {
                alert(data.message || 'Có lỗi xảy ra');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi xóa danh mục');
        });
    }
}
```

## Test Checklist

### Category List (index.php?page=categories)

- [ ] **Display**
  - [ ] Hiển thị đúng cấu trúc tree (cha-con)
  - [ ] Icon phân biệt rõ danh mục gốc và danh mục con
  - [ ] Indent đúng cho các cấp
  - [ ] Hiển thị đầy đủ các trường: ID, Name, Description, Parent, Status
  - [ ] Status có màu sắc phân biệt (active=green, inactive=red)

- [ ] **Search**
  - [ ] Tìm kiếm theo tên danh mục
  - [ ] Enter để search
  - [ ] Hiển thị empty state khi không tìm thấy

- [ ] **Filter**
  - [ ] Filter theo status: All, Active, Inactive
  - [ ] Cập nhật số lượng hiển thị sau khi filter

- [ ] **Sort**
  - [ ] Sắp xếp A-Z và Z-A
  - [ ] Toggle giữa ascending và descending

- [ ] **Actions**
  - [ ] Nút "Thêm Danh Mục" chuyển đến form
  - [ ] Nút "Sửa" chuyển đến form với dữ liệu
  - [ ] Nút "Xóa" hiển thị confirm dialog

- [ ] **Responsive**
  - [ ] Desktop: Hiển thị đầy đủ
  - [ ] Tablet: Layout điều chỉnh phù hợp
  - [ ] Mobile: Actions bar xếp dọc

### Category Form (index.php?page=category-form)

- [ ] **Add Mode**
  - [ ] Form trống với giá trị mặc định
  - [ ] Status mặc định là "active"
  - [ ] Parent dropdown hiển thị đầy đủ danh mục

- [ ] **Edit Mode**
  - [ ] Tự động điền dữ liệu danh mục đang sửa
  - [ ] Parent dropdown không chứa chính nó
  - [ ] Header hiển thị "Sửa Danh Mục: [Tên]"

- [ ] **Validation**
  - [ ] Name: Required, min 2 chars, max 100 chars
  - [ ] Description: Optional, max 500 chars
  - [ ] Parent: Optional, valid category ID
  - [ ] Status: Required
  - [ ] Real-time validation cho Name field
  - [ ] Hiển thị error messages rõ ràng

- [ ] **Parent Selection**
  - [ ] Dropdown hierarchical (có indent)
  - [ ] Không chọn được chính nó (khi edit)
  - [ ] Không chọn được con của nó (khi edit)
  - [ ] Option "Không có" để tạo root category

- [ ] **Actions**
  - [ ] Nút "Hủy" quay về danh sách
  - [ ] Nút "Làm Mới" reset form
  - [ ] Nút "Lưu/Cập Nhật" submit form
  - [ ] Loading state khi đang submit

- [ ] **Messages**
  - [ ] Success message sau khi save
  - [ ] Error messages validation
  - [ ] Auto redirect sau success

- [ ] **Responsive**
  - [ ] Desktop: 2 columns layout
  - [ ] Mobile: Single column, stack vertically

### API Integration Tests

- [ ] **GET /api/categories**
  - [ ] Trả về danh sách đầy đủ
  - [ ] Filter by status hoạt động
  - [ ] Search hoạt động
  - [ ] Pagination hoạt động

- [ ] **POST /api/categories**
  - [ ] Tạo danh mục thành công
  - [ ] Validate name required
  - [ ] Validate duplicate name (cùng parent)
  - [ ] Validate parent_id tồn tại

- [ ] **PUT /api/categories/{id}**
  - [ ] Cập nhật thành công
  - [ ] Không cho phép self-reference
  - [ ] Không cho phép circular reference

- [ ] **DELETE /api/categories/{id}**
  - [ ] Xóa thành công
  - [ ] Không xóa nếu có children
  - [ ] Không xóa nếu có products

## Customization

### Thay đổi màu sắc

File: `views/categories/index.php` và `views/categories/form.php`

```css
/* Active status - Xanh lá */
bg-green-100 text-green-800 → bg-blue-100 text-blue-800

/* Inactive status - Đỏ */
bg-red-100 text-red-800 → bg-gray-100 text-gray-800

/* Primary buttons */
bg-indigo-600 hover:bg-indigo-700 → bg-blue-600 hover:bg-blue-700
```

### Thêm fields mới

**Ví dụ**: Thêm field "slug" cho category

1. **Controller**: Thêm vào sample data
```php
['id' => 1, 'name' => 'Đồ uống', 'slug' => 'do-uong', ...]
```

2. **List View**: Thêm cột mới
```html
<th>Slug</th>
...
<td><?php echo $category['slug']; ?></td>
```

3. **Form View**: Thêm input field
```html
<div>
    <label for="slug">Slug</label>
    <input type="text" id="slug" name="slug" 
        value="<?php echo $category['slug'] ?? ''; ?>">
</div>
```

### Thêm tính năng Drag & Drop

Sử dụng thư viện như SortableJS để reorder categories:

```html
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
var el = document.getElementById('categoryTableBody');
var sortable = Sortable.create(el, {
    animation: 150,
    onEnd: function (evt) {
        // Update display_order via API
        updateCategoryOrder(evt.oldIndex, evt.newIndex);
    }
});
</script>
```

## Troubleshooting

### Vấn đề: Tree structure không hiển thị đúng

**Giải pháp**: Kiểm tra parent_id trong dữ liệu, đảm bảo:
- Root categories có `parent_id = null`
- Child categories có `parent_id` valid

### Vấn đề: Form validation không hoạt động

**Giải pháp**: Kiểm tra:
- JavaScript được load đúng
- Function `validateForm()` được gọi trong `onsubmit`
- Console không có lỗi JavaScript

### Vấn đề: API call không hoạt động

**Giải pháp**: Kiểm tra:
- API endpoints đúng
- CORS settings
- Network tab trong DevTools
- Response format

## Best Practices

1. **Validation**: Luôn validate cả client-side và server-side
2. **Error Handling**: Hiển thị error messages rõ ràng cho user
3. **Loading States**: Hiển thị loading indicator khi đang xử lý
4. **Confirmation**: Hỏi xác nhận trước khi xóa
5. **Responsive**: Test trên nhiều kích thước màn hình
6. **Accessibility**: Sử dụng semantic HTML và ARIA labels
7. **Performance**: Limit pagination, lazy load nếu cần

## Support

Nếu cần hỗ trợ, vui lòng tham khảo:
- [API Documentation](CATEGORY_API.md)
- [README.md](../README.md)
