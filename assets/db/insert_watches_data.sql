
-- Thêm thương hiệu
INSERT INTO brands (brand_name, brand_description, stock_quantity, brands_images) VALUES
('Omega', 'Thương hiệu đồng hồ Thụy Sĩ nổi tiếng với độ chính xác cao.', 100, 'images/Ảnh đồng hồ/omega/omega_logo.png'),
('Patek Philippe', 'Một trong những thương hiệu đồng hồ sang trọng và danh giá nhất thế giới.', 100, 'images/Ảnh đồng hồ/Patek Philippe/petek_logo.png'),
('Rolex', 'Thương hiệu đồng hồ xa xỉ nổi tiếng với thiết kế đẳng cấp và độ bền cao.', 100, 'images/Ảnh đồng hồ/rolex/rolex_logo.png');

-- Omega Watches
INSERT INTO watches (brand_id, model, price, type, description, store_quantity, watches_images)
VALUES
(1, 'Omega1', 12000000.00, 'Fashion', 'Mẫu Omega 1 phiên bản basic', 10, 'images/Ảnh đồng hồ/omega/Omega1_basic.jpg'),
(1, 'Omega1', 18000000.00, 'Vintage', 'Mẫu Omega 1 phiên bản classic', 10, 'images/Ảnh đồng hồ/omega/Omega1_classic.png'),
(1, 'Omega1', 25000000.00, 'Luxury', 'Mẫu Omega 1 phiên bản luxury', 5, 'images/Ảnh đồng hồ/omega/Omega1_luxury.png'),
(1, 'Omega2', 13000000.00, 'Fashion', 'Mẫu Omega 2 phiên bản basic', 10, 'images/Ảnh đồng hồ/omega/Omega2_basic.png'),
(1, 'Omega2', 19000000.00, 'Vintage', 'Mẫu Omega 2 phiên bản classic', 10, 'images/Ảnh đồng hồ/omega/Omega2_classic.png'),
(1, 'Omega2', 26000000.00, 'Luxury', 'Mẫu Omega 2 phiên bản luxury', 5, 'images/Ảnh đồng hồ/omega/Omega2_luxury.webp'),
(1, 'Omega3', 14000000.00, 'Fashion', 'Mẫu Omega 3 phiên bản basic', 10, 'images/Ảnh đồng hồ/omega/Omega3_basic.webp'),
(1, 'Omega3', 2000000.00, 'Vintage', 'Mẫu Omega 3 phiên bản classic', 10, 'images/Ảnh đồng hồ/omega/Omega3_classic.png'),
(1, 'Omega3', 27000000.00, 'Luxury', 'Mẫu Omega 3 phiên bản luxury', 5, 'images/Ảnh đồng hồ/omega/Omega3_luxury.png'),
(1, 'Omega4', 2000000.00, 'Vintage', 'Mẫu Omega 4 phiên bản classic', 10, 'images/Ảnh đồng hồ/omega/Omega4_classic.png');

-- Patek Philippe Watches
INSERT INTO watches (brand_id, model, price, type, description, store_quantity, watches_images)
VALUES
(2, 'Patek Philippe 1', 8000000.00, 'Fashion', 'Mẫu Patek Philippe 1 phiên bản basic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe1_basic.jpg'),
(2, 'Patek Philippe 1', 11000000.00, 'Vintage', 'Mẫu Patek Philippe 1 phiên bản classic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe1_classic.jpg'),
(2, 'Patek Philippe 1', 15000000.00, 'Luxury', 'Mẫu Patek Philippe 1 phiên bản luxury', 2, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe1_luxury.jpg'),
(2, 'Patek Philippe 2', 85000000.00, 'Fashion', 'Mẫu Patek Philippe 2 phiên bản basic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe2_basic.jpg'),
(2, 'Patek Philippe 2', 115000000.00, 'Vintage', 'Mẫu Patek Philippe 2 phiên bản classic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe2_classic.jpg'),
(2, 'Patek Philippe 2', 16000000.00, 'Luxury', 'Mẫu Patek Philippe 2 phiên bản luxury', 2, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe2_luxury.jpg'),
(2, 'Patek Philippe 3', 87000000.00, 'Fashion', 'Mẫu Patek Philippe 3 phiên bản basic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe3_basic.jpg'),
(2, 'Patek Philippe 3', 117000000.00, 'Vintage', 'Mẫu Patek Philippe 3 phiên bản classic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe3_classic.jpg'),
(2, 'Patek Philippe 3', 165000000.00, 'Luxury', 'Mẫu Patek Philippe 3 phiên bản luxury', 2, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe3_luxury.jpg'),
(2, 'Patek Philippe 4', 118000000.00, 'Vintage', 'Mẫu Patek Philippe 4 phiên bản classic', 5, 'images/Ảnh đồng hồ/Patek Philippe/patek_philippe4_classic.jpg');

-- Rolex Watches
INSERT INTO watches (brand_id, model, price, type, description, store_quantity, watches_images)
VALUES
(3, 'Rolex 1', 5000000.00, 'Luxury', 'Rolex mẫu 1', 7, 'images/Ảnh đồng hồ/rolex/rolex1.png'),
(3, 'Rolex 2', 52000000.00, 'Luxury', 'Rolex mẫu 2', 7, 'images/Ảnh đồng hồ/rolex/rolex2.png'),
(3, 'Rolex 3', 53000000.00, 'Luxury', 'Rolex mẫu 3', 7, 'images/Ảnh đồng hồ/rolex/rolex3.png'),
(3, 'Rolex 4', 54000000.00, 'Luxury', 'Rolex mẫu 4', 7, 'images/Ảnh đồng hồ/rolex/rolex4.png'),
(3, 'Rolex 5', 55000000.00, 'Luxury', 'Rolex mẫu 5', 7, 'images/Ảnh đồng hồ/rolex/rolex5.png'),
(3, 'Rolex 6', 56000000.00, 'Luxury', 'Rolex mẫu 6', 7, 'images/Ảnh đồng hồ/rolex/rolex6.png'),
(3, 'Rolex 7', 57000000.00, 'Luxury', 'Rolex mẫu 7', 7, 'images/Ảnh đồng hồ/rolex/rolex7.png'),
(3, 'Rolex 8', 58000000.00, 'Luxury', 'Rolex mẫu 8', 7, 'images/Ảnh đồng hồ/rolex/rolex8.png'),
(3, 'Rolex 9', 59000000.00, 'Luxury', 'Rolex mẫu 9', 7, 'images/Ảnh đồng hồ/rolex/rolex9.png'),
(3, 'Rolex 10', 6000000.00, 'Luxury', 'Rolex mẫu 10', 7, 'images/Ảnh đồng hồ/rolex/rolex10.png');


INSERT INTO roles (role_id, role_name, role_description) VALUES
(1, 'Admin', 'Quản trị hệ thống'),
(2, 'Customer', 'Khách hàng thông thường');
