# ALBERTO CLOCK

## Mô tả dự án

Dự án **ALBERTO CLOCK** là một trang web bán đồng hồ online, cho phép người dùng duyệt các mẫu đồng hồ, thêm chúng vào giỏ hàng và thanh toán online. Dự án cũng bao gồm một khu vực quản trị để quản lý sản phẩm và đơn hàng.

## Cấu trúc thư mục

Cấu trúc thư mục của dự án được tổ chức theo mô hình **MVC (Model-View-Controller)** đơn giản giúp tách biệt các thành phần của ứng dụng, dễ dàng quản lý và bảo trì mã nguồn. Dưới đây là mô tả chi tiết về từng thư mục và mục đích sử dụng của chúng.

### Mô tả chi tiết các thư mục:

#### **`assets/`**:

- **`css/`**: Chứa các file CSS để định dạng giao diện trang web. Ví dụ: **`style.css`** là file CSS chính.
- **`js/`**: Chứa các file JavaScript, bao gồm các thư viện như **`bootstrap.min.js`** và các script tùy chỉnh như **`main.js`**.
- **`images/`**: Chứa các hình ảnh của sản phẩm và các hình ảnh chung của trang web, như logo và banner.

#### **`includes/`**:

- **`header.php`**: Chứa phần đầu trang của website, bao gồm **menu**, **logo**, và các thẻ meta.
- **`footer.php`**: Chứa phần chân trang của website, bao gồm **thông tin liên hệ**, **copyright**.
- **`db_connect.php`**: Chứa logic kết nối đến cơ sở dữ liệu, giúp các file khác dễ dàng kết nối với cơ sở dữ liệu.
- **`functions.php`**: Chứa các hàm PHP tái sử dụng như xử lý dữ liệu, thêm/sửa/xóa thông tin trong cơ sở dữ liệu.

#### **`admin/`**:

- **`index.php`**: Trang chính của admin, nơi quản trị viên có thể xem thống kê hoặc điều khiển tổng quan về website.
- **`login.php`**: Trang đăng nhập cho quản trị viên.
- **`products_manage.php`**: Quản lý sản phẩm (thêm, sửa, xóa các sản phẩm đồng hồ).
- **`orders_manage.php`**: Quản lý đơn hàng (hiển thị và xử lý đơn hàng).
- **`assets_admin/`**: Các file CSS/JS riêng biệt dành cho trang quản trị.

#### **`models/`**:

- **`Brand.php`**: Chứa lớp PHP xử lý các thao tác với bảng **Brands** trong cơ sở dữ liệu.
- **`Product.php`**: Chứa lớp PHP xử lý các thao tác với bảng **Watches**.
- **`Cart.php`**: Chứa lớp PHP xử lý các thao tác với bảng **Cart** và **Cart_Details**.
- **`User.php`**: Chứa lớp PHP xử lý các thao tác với bảng **Users**.

#### **`controllers/`**:

- **`ProductController.php`**: Điều khiển logic các trang sản phẩm (liệt kê, chi tiết sản phẩm).
- **`CartController.php`**: Điều khiển các thao tác với giỏ hàng (thêm, xóa, tính toán tổng tiền giỏ hàng).
- **`UserController.php`**: Điều khiển các thao tác với người dùng (đăng ký, đăng nhập).

#### **`views/`**:

- **`index.php`**: Trang chủ của website, hiển thị các sản phẩm nổi bật hoặc thông tin chính về cửa hàng.
- **`products.php`**: Trang danh sách sản phẩm.
- **`product_detail.php`**: Trang chi tiết sản phẩm, hiển thị thông tin chi tiết về sản phẩm đồng hồ.
- **`cart.php`**: Trang giỏ hàng, nơi người dùng có thể xem và điều chỉnh các sản phẩm trong giỏ.
- **`checkout.php`**: Trang thanh toán, nơi người dùng hoàn tất đơn hàng.
- **`login.php`**: Trang đăng nhập người dùng.
- **`register.php`**: Trang đăng ký người dùng (đã thêm vào).
- **`contact.php`**: Trang liên hệ, nơi người dùng có thể gửi câu hỏi hoặc yêu cầu.

#### **`process/`**:

- **`process_cart.php`**: Xử lý các thao tác với giỏ hàng, chẳng hạn như thêm hoặc xóa sản phẩm.
- **`process_login.php`**: Xử lý đăng nhập người dùng.
- **`process_register.php`**: Xử lý đăng ký người dùng.

### Tóm tắt:

Cấu trúc thư mục này giúp bạn tổ chức dự án một cách dễ hiểu, dễ bảo trì, và dễ phát triển. Các thành viên trong nhóm sẽ dễ dàng hiểu được cách thức hoạt động của từng phần trong dự án và có thể đóng góp vào các phần khác nhau mà không gặp phải sự chồng chéo.


