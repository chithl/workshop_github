# API Documentation - Category Management

## Tổng quan

Tài liệu này mô tả các API endpoints để quản lý danh mục sản phẩm trong hệ thống Coffee Shop Admin.

## Base URL

```
{BASE_URL}/api/categories
```

Replace `{BASE_URL}` with your application's base URL (e.g., `http://localhost/workshop_github` or `https://yourdomain.com`).

## Endpoints

### 1. Lấy danh sách danh mục

**GET** `/api/categories`

Lấy danh sách tất cả các danh mục với cấu trúc phân cấp.

#### Query Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| status | string | No | Filter theo trạng thái: `active`, `inactive` |
| search | string | No | Tìm kiếm theo tên danh mục |
| parent_id | integer | No | Lọc theo danh mục cha (null để lấy danh mục gốc) |
| page | integer | No | Số trang (mặc định: 1) |
| limit | integer | No | Số bản ghi mỗi trang (mặc định: 10) |

#### Response Success (200)

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Đồ uống",
      "description": "Tất cả các loại đồ uống",
      "parent_id": null,
      "status": "active",
      "display_order": 0,
      "created_at": "2024-01-01 10:00:00",
      "updated_at": "2024-01-01 10:00:00",
      "children": [
        {
          "id": 2,
          "name": "Cà phê",
          "description": "Các loại cà phê",
          "parent_id": 1,
          "status": "active",
          "display_order": 1,
          "created_at": "2024-01-01 10:00:00",
          "updated_at": "2024-01-01 10:00:00",
          "children": []
        }
      ]
    }
  ],
  "pagination": {
    "total": 10,
    "page": 1,
    "limit": 10,
    "total_pages": 1
  }
}
```

### 2. Lấy thông tin một danh mục

**GET** `/api/categories/{id}`

#### URL Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| id | integer | Yes | ID của danh mục |

#### Response Success (200)

```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Đồ uống",
    "description": "Tất cả các loại đồ uống",
    "parent_id": null,
    "status": "active",
    "display_order": 0,
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-01 10:00:00"
  }
}
```

#### Response Error (404)

```json
{
  "success": false,
  "message": "Danh mục không tồn tại"
}
```

### 3. Tạo danh mục mới

**POST** `/api/categories`

#### Request Body

```json
{
  "name": "Cà phê",
  "description": "Các loại cà phê",
  "parent_id": 1,
  "status": "active",
  "display_order": 0
}
```

#### Validation Rules

| Field | Type | Required | Rules |
|-------|------|----------|-------|
| name | string | Yes | Min: 2, Max: 100, Unique (trong cùng cấp cha) |
| description | string | No | Max: 500 |
| parent_id | integer | No | Phải là ID của danh mục tồn tại |
| status | string | Yes | Enum: `active`, `inactive` |
| display_order | integer | No | Min: 0 |

#### Response Success (201)

```json
{
  "success": true,
  "message": "Tạo danh mục thành công",
  "data": {
    "id": 11,
    "name": "Cà phê",
    "description": "Các loại cà phê",
    "parent_id": 1,
    "status": "active",
    "display_order": 0,
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-01 10:00:00"
  }
}
```

#### Response Error (422)

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "name": ["Tên danh mục đã tồn tại"],
    "parent_id": ["Danh mục cha không tồn tại"]
  }
}
```

### 4. Cập nhật danh mục

**PUT** `/api/categories/{id}`

hoặc

**PATCH** `/api/categories/{id}`

#### URL Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| id | integer | Yes | ID của danh mục cần cập nhật |

#### Request Body

```json
{
  "name": "Cà phê đặc biệt",
  "description": "Các loại cà phê đặc biệt",
  "parent_id": 1,
  "status": "active",
  "display_order": 1
}
```

#### Response Success (200)

```json
{
  "success": true,
  "message": "Cập nhật danh mục thành công",
  "data": {
    "id": 2,
    "name": "Cà phê đặc biệt",
    "description": "Các loại cà phê đặc biệt",
    "parent_id": 1,
    "status": "active",
    "display_order": 1,
    "created_at": "2024-01-01 10:00:00",
    "updated_at": "2024-01-01 11:00:00"
  }
}
```

#### Response Error (422)

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "parent_id": ["Không thể chọn chính nó hoặc danh mục con làm danh mục cha"]
  }
}
```

### 5. Xóa danh mục

**DELETE** `/api/categories/{id}`

#### URL Parameters

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| id | integer | Yes | ID của danh mục cần xóa |

#### Response Success (200)

```json
{
  "success": true,
  "message": "Xóa danh mục thành công"
}
```

#### Response Error (409)

```json
{
  "success": false,
  "message": "Không thể xóa danh mục có danh mục con hoặc sản phẩm"
}
```

## Ví dụ sử dụng

### JavaScript (Fetch API)

```javascript
// Lấy danh sách danh mục
async function getCategories() {
  try {
    const response = await fetch('/api/categories?status=active');
    const data = await response.json();
    
    if (data.success) {
      console.log('Categories:', data.data);
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

// Tạo danh mục mới
async function createCategory(categoryData) {
  try {
    const response = await fetch('/api/categories', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(categoryData)
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Category created:', data.data);
    } else {
      console.error('Errors:', data.errors);
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

// Cập nhật danh mục
async function updateCategory(id, categoryData) {
  try {
    const response = await fetch(`/api/categories/${id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(categoryData)
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Category updated:', data.data);
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

// Xóa danh mục
async function deleteCategory(id) {
  if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
    try {
      const response = await fetch(`/api/categories/${id}`, {
        method: 'DELETE'
      });
      
      const data = await response.json();
      
      if (data.success) {
        console.log('Category deleted');
        window.location.reload();
      }
    } catch (error) {
      console.error('Error:', error);
    }
  }
}
```

### PHP (cURL)

```php
<?php
// Lấy danh sách danh mục
function getCategories($status = null) {
    $url = 'http://localhost/api/categories';
    if ($status) {
        $url .= '?status=' . $status;
    }
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

// Tạo danh mục mới
function createCategory($data) {
    $ch = curl_init('http://localhost/api/categories');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

// Cập nhật danh mục
function updateCategory($id, $data) {
    $ch = curl_init('http://localhost/api/categories/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}

// Xóa danh mục
function deleteCategory($id) {
    $ch = curl_init('http://localhost/api/categories/' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response, true);
}
?>
```

## Error Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 404 | Not Found |
| 409 | Conflict |
| 422 | Validation Error |
| 500 | Server Error |

## Notes

- Tất cả timestamps ở định dạng `Y-m-d H:i:s` (UTC)
- Tên danh mục phải là duy nhất trong cùng cấp cha
- Không thể xóa danh mục có danh mục con hoặc có sản phẩm
- Không thể chọn chính nó hoặc danh mục con làm danh mục cha khi cập nhật
- Status có 2 giá trị: `active` (hoạt động) hoặc `inactive` (không hoạt động)
