# 🕒 ALBERTO CLOCK

## 📝 Giới thiệu

**ALBERTO CLOCK** là một trang web thương mại điện tử chuyên bán đồng hồ, mang đến trải nghiệm duyệt sản phẩm, thêm vào giỏ hàng và thanh toán trực tuyến. Dự án cũng có khu vực quản trị dành cho quản trị viên để quản lý sản phẩm và đơn hàng.

---

## 📁 Cấu trúc Dự án (MVC)

Dự án được tổ chức theo mô hình **MVC (Model - View - Controller)** để phân tách rõ ràng giữa dữ liệu, giao diện và logic xử lý.

### 1. `assets/` – Tài nguyên giao diện

- `css/`: File CSS chính (ví dụ: `style.css`)
- `js/`: File JavaScript và thư viện (ví dụ: `main.js`, `bootstrap.min.js`)
- `images/`: Hình ảnh sản phẩm, logo, banner...

### 2. `includes/` – Thành phần dùng chung

- `header.php`: Giao diện đầu trang (menu, logo, meta)
- `footer.php`: Chân trang (thông tin liên hệ, bản quyền)
- `db_connect.php`: Kết nối cơ sở dữ liệu
- `functions.php`: Các hàm PHP tái sử dụng

### 3. `admin/` – Giao diện Quản trị

- `index.php`: Trang chính cho quản trị viên
- `login.php`: Trang đăng nhập quản trị
- `products_manage.php`: Quản lý sản phẩm (thêm, sửa, xóa)
- `orders_manage.php`: Quản lý đơn hàng
- `assets_admin/`: Tài nguyên riêng cho giao diện quản trị

### 4. `models/` – Xử lý Dữ liệu (Model)

- `Brand.php`: Quản lý bảng **Brands**
- `Product.php`: Quản lý bảng **Watches**
- `Cart.php`: Quản lý giỏ hàng và chi tiết
- `User.php`: Quản lý người dùng

### 5. `controllers/` – Điều phối Dữ liệu (Controller)

- `ProductController.php`: Hiển thị sản phẩm
- `CartController.php`: Quản lý giỏ hàng
- `UserController.php`: Đăng ký, đăng nhập người dùng

### 6. `views/` – Giao diện Người dùng (View)

- `index.php`: Trang chủ
- `products.php`: Danh sách sản phẩm
- `product_detail.php`: Thông tin chi tiết sản phẩm
- `cart.php`: Trang giỏ hàng
- `checkout.php`: Trang thanh toán
- `login.php`: Đăng nhập người dùng
- `register.php`: Đăng ký người dùng
- `contact.php`: Trang liên hệ

### 7. `process/` – Xử lý các hành động người dùng

- `process_cart.php`: Xử lý giỏ hàng
- `process_login.php`: Xử lý đăng nhập
- `process_register.php`: Xử lý đăng ký

---

## ✅ Lợi ích của cấu trúc này

- **Rõ ràng**: Tách biệt từng phần giúp dễ hiểu và dễ mở rộng.
- **Dễ bảo trì**: Có thể chỉnh sửa từng phần riêng mà không ảnh hưởng phần khác.
- **Hợp tác hiệu quả**: Dễ dàng phân chia công việc giữa các thành viên trong nhóm.

---


