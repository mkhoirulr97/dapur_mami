-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.4.24-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Membuang data untuk tabel dapur_mami.delivery_orders: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `delivery_orders` DISABLE KEYS */;
INSERT IGNORE INTO `delivery_orders` (`id`, `users_id`, `invoice`, `customer_name`, `payment_method`, `total_payment`, `sub_total`, `status`, `delivery_time`, `delivery_date`, `delivery_address`, `delivery_phone`, `delivery_note`, `updated_by`, `payment_proof`, `created_at`, `updated_at`, `payment_at`, `expired_at`) VALUES
	(8, 5, 'INV-202305-0008', 'Anindhyta Akmala', 'transfer', 25000, 25000, 3, '11:32:42', '2023-05-08', 'Sumber Sari, Jember, Jawa Timur', '081515144983', 'asd', NULL, 'INV-202305-0008-1683016814_WhatsApp Image 2023-05-01 at 07.10.18.jpeg', '2023-05-08 11:32:42', '2023-05-09 04:09:31', '2023-05-08 12:25:51', '2023-05-08 13:00:00'),
	(9, 5, 'INV-202305-0009', 'Anindhyta Akmala', 'transfer', 40000, 40000, 4, '12:15:28', '2023-05-08', 'Sumber Sari, Jember, Jawa Timur', '081515144983', 'coba', NULL, NULL, '2023-05-08 12:15:28', '2023-05-08 15:35:37', NULL, '2023-05-08 16:15:28'),
	(10, 5, 'INV-202305-0010', 'Anindhyta Akmala', 'transfer', 15000, 15000, 3, '11:57:15', '2023-05-09', 'Sumber Sari, Jember, Jawa Timur', '081515144983', 'asd', NULL, 'INV-202305-0010-1683016814_WhatsApp Image 2023-05-01 at 07.10.18.jpeg', '2023-05-09 11:57:15', '2023-05-09 11:58:49', '2023-05-09 11:57:59', '2023-05-09 13:57:15'),
	(11, 5, 'INV-202305-0011', 'Anindhyta Akmala', 'transfer', 10000, 10000, 3, '12:49:53', '2023-05-09', 'Sumber Sari, Jember, Jawa Timur', '081515144983', 'sddadklj', NULL, 'INV-202305-0011-1683016814_WhatsApp Image 2023-05-01 at 07.10.18.jpeg', '2023-05-09 12:49:53', '2023-05-09 12:51:49', '2023-05-09 12:50:56', '2023-05-09 14:49:53');
/*!40000 ALTER TABLE `delivery_orders` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.detail_delivery_orders: ~6 rows (lebih kurang)
/*!40000 ALTER TABLE `detail_delivery_orders` DISABLE KEYS */;
INSERT IGNORE INTO `detail_delivery_orders` (`id`, `delivery_orders_id`, `menu_id`, `price`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
	(16, 8, 2, 15000, 1, 15000, '2023-05-08 11:32:42', '2023-05-08 11:32:42'),
	(17, 8, 6, 10000, 1, 10000, '2023-05-08 11:32:42', '2023-05-08 11:32:42'),
	(18, 9, 1, 10000, 2, 20000, '2023-05-08 12:15:28', '2023-05-08 12:15:28'),
	(19, 9, 3, 10000, 2, 20000, '2023-05-08 12:15:28', '2023-05-08 12:15:28'),
	(20, 10, 1, 10000, 1, 10000, '2023-05-09 11:57:15', '2023-05-09 11:57:15'),
	(21, 10, 4, 5000, 1, 5000, '2023-05-09 11:57:15', '2023-05-09 11:57:15'),
	(22, 11, 1, 10000, 1, 10000, '2023-05-09 12:49:53', '2023-05-09 12:49:53');
/*!40000 ALTER TABLE `detail_delivery_orders` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.discounts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.discount_menus: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `discount_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_menus` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.material_transactions: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `material_transactions` DISABLE KEYS */;
INSERT IGNORE INTO `material_transactions` (`id`, `transaction_code`, `total_paid`, `total_return`, `total_purchase`, `status`, `suppliers`, `purchase_note`, `purchase_proof`, `purchase_date`, `user_id`, `created_at`, `updated_at`, `cashier_id`) VALUES
	(1, 'MT644e5c0ee052b', 100000, 20000, 72000, 3, NULL, NULL, '1682857810_WhatsApp Image 2023-04-29 at 08.40.17.jpeg', '2023-04-30', 1, '2023-04-30 12:16:14', '2023-04-30 12:30:10', 2),
	(2, 'MT644e5c4d22f06', 50000, 0, 40000, 1, NULL, NULL, NULL, NULL, 1, '2023-04-30 12:17:17', '2023-04-30 12:17:17', NULL),
	(3, 'MT6450bf311f165', 100000, 0, 276, 1, NULL, NULL, NULL, NULL, 1, '2023-05-02 07:43:45', '2023-05-02 07:43:45', NULL),
	(4, 'MT6450bf3f55c2d', 1000000, 0, 230, 1, NULL, NULL, NULL, NULL, 1, '2023-05-02 07:43:59', '2023-05-02 07:43:59', NULL),
	(5, 'MT6450bfbd4837c', 33234, 0, 2342, 1, NULL, NULL, NULL, NULL, 1, '2023-05-02 07:46:05', '2023-05-02 07:46:05', NULL);
/*!40000 ALTER TABLE `material_transactions` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.material_transaction_details: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `material_transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `material_transaction_details` (`id`, `material_transaction_id`, `name`, `unit_type`, `quantity`, `ppu`, `total`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Gula', 'kg', 1, 12000, 12000, 1, '2023-04-30 12:16:14', '2023-04-30 12:30:10'),
	(2, 1, 'Beras', 'kg', 5, 12000, 60000, 1, '2023-04-30 12:16:14', '2023-04-30 12:30:10'),
	(3, 2, 'Minyak', 'l', 5, 8000, 40000, 0, '2023-04-30 12:17:17', '2023-04-30 12:17:17'),
	(4, 3, 'Perinatal', 'kg', 12, 23, 276, 0, '2023-05-02 07:43:45', '2023-05-02 07:43:45'),
	(5, 4, 'Beras', 'kg', 23, 10, 230, 0, '2023-05-02 07:43:59', '2023-05-02 07:43:59'),
	(6, 5, 'seda', 'kg', 1, 2342, 2342, 0, '2023-05-02 07:46:05', '2023-05-02 07:46:05');
/*!40000 ALTER TABLE `material_transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.menus: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT IGNORE INTO `menus` (`id`, `name`, `price`, `category`, `description`, `weight`, `discounts_id`, `active`, `created_at`, `updated_at`, `image`) VALUES
	(1, 'Nasi Goreng', 10000, 1, 'Nasi goreng dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:53:53', 'images/menu/1682988833.jpg'),
	(2, 'Nasi Goreng Spesial', 15000, 1, 'Nasi goreng dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:54:30', 'images/menu/1682988870.jpg'),
	(3, 'Soto Ayam', 10000, 1, 'Soto ayam dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:54:40', 'images/menu/1682988880.jpg'),
	(4, 'Es Teh', 5000, 2, 'Es teh dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:59:16', 'images/menu/1682989156.jpg'),
	(5, 'Es Jeruk', 5000, 2, 'Es jeruk dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:59:26', 'images/menu/1682989166.jpg'),
	(6, 'Es Campur', 10000, 2, 'Es campur dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 00:59:50', 'images/menu/1682989190.jpg'),
	(7, 'Keripik', 5000, 3, 'Keripik dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 01:00:05', 'images/menu/1682989205.jpg'),
	(8, 'Keripik Kacang', 5000, 3, 'Keripik kacang dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 01:01:24', 'images/menu/1682989284.jpeg'),
	(9, 'Keripik Tempe', 5000, 3, 'Keripik tempe dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-05-02 01:01:35', 'images/menu/1682989295.jpg');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.migrations: ~26 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2014_10_12_000000_create_users_table', 1),
	(24, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(25, '2019_08_19_000000_create_failed_jobs_table', 1),
	(26, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(27, '2023_02_22_160644_create_discounts_table', 1),
	(28, '2023_02_22_160850_create_menus_table', 1),
	(29, '2023_02_22_221553_create_discount_menus_table', 1),
	(30, '2023_02_22_221935_create_transactions_table', 1),
	(31, '2023_02_26_141357_add_image_menu', 1),
	(32, '2023_03_01_103145_create_transaction_details_table', 1),
	(33, '2023_03_01_110657_add_relation_transactions_transaction_details', 1),
	(34, '2023_03_02_222145_delete_column_transaction_details', 1),
	(35, '2023_03_02_223859_remove_amount_item_transaction_details', 1),
	(36, '2023_03_03_095714_remove_total_price_transaction_details', 1),
	(37, '2023_03_04_114056_add_sub_total_transactions', 1),
	(38, '2023_03_05_044002_add_some_columns_transactions', 1),
	(39, '2023_03_05_044915_update_customer_name_transactions', 1),
	(40, '2023_04_03_034506_material_transactions_table', 1),
	(41, '2023_04_03_034841_material_transaction_details_table', 1),
	(42, '2023_04_06_070133_update_unit_type_column_material_transaction_details', 1),
	(43, '2023_04_06_075824_update_some_columns_material_transaction', 1),
	(44, '2023_04_29_232355_add_purchase_note_and_puchase_proof_material_transaction_table', 1),
	(45, '2023_04_30_122448_add_chasier_id_column_material_transactions', 2),
	(46, '2023_05_05_072705_create_reservation_config_table', 3),
	(47, '2023_05_06_223155_create_setting_table', 4),
	(50, '2023_05_06_224036_create_delivery_order_table', 5),
	(51, '2023_05_06_224102_create_detail_delivery_orders_table', 5),
	(53, '2023_05_08_105937_add_payment_at_expired_at_columns_delivery_orders', 6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.password_reset_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.reservation_config: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `reservation_config` DISABLE KEYS */;
INSERT IGNORE INTO `reservation_config` (`id`, `capacity`, `max_reservation_per_day`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 50, 6, 1, '2023-05-05 07:40:28', '2023-05-05 08:46:07');
/*!40000 ALTER TABLE `reservation_config` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.setting: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT IGNORE INTO `setting` (`id`, `name`, `address`, `phone`, `bank_name`, `bank_account`, `bank_account_name`, `open_at`, `close_at`, `created_at`, `updated_at`) VALUES
	(1, 'Dapur Mami', 'Jl. Anggrek, Logandang Barat, Talkandang, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68315', '081515144981', 'BRI', '0001-01-011822-53-4', 'Dapur Mami', '16:00:00', '22:00:00', '2023-05-06 22:37:14', '2023-05-09 16:11:17');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.transactions: ~8 rows (lebih kurang)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT IGNORE INTO `transactions` (`id`, `users_id`, `discounts_id`, `transaction_code`, `customer_name`, `payment_method`, `total_payment`, `sub_total`, `status`, `created_at`, `updated_at`, `event_name`, `total_guest`, `booking_date`, `booking_time`) VALUES
	(1, 1, NULL, 'INV-2023-0001', 'Khoirul', 1, 20000, 20000, 2, '2023-04-30 11:55:00', '2023-05-06 01:48:38', NULL, NULL, NULL, NULL),
	(2, 1, NULL, 'INV-2023-0002', NULL, 1, 75000, 75000, 2, '2023-04-30 11:59:26', '2023-04-30 12:00:38', 'Ulang Tahun Mira', 5, '2023-05-07', '14:00:00'),
	(4, 1, NULL, 'INV-2023-0003', NULL, 1, 225000, 225000, 2, '2023-04-30 16:39:18', '2023-04-30 16:39:18', 'Reuni SMP Pelita Hati', 5, '2023-05-07', '12:00:00'),
	(5, 1, NULL, 'INV-2023-0004', 'Jhoni', 1, 10000, 10000, 2, '2023-04-30 17:01:47', '2023-05-02 01:06:48', NULL, NULL, NULL, NULL),
	(6, 1, NULL, 'INV-2023-0005', NULL, 1, 1635000, 1635000, 2, '2023-05-05 08:30:20', '2023-05-05 08:31:36', 'Wisuda Amir', 40, '2023-05-07', '15:28:00'),
	(7, 1, NULL, 'INV-2023-0006', 'Ibnu', 1, 75000, 75000, 2, '2023-05-05 09:05:00', '2023-05-06 01:45:35', NULL, NULL, NULL, NULL),
	(8, 1, NULL, 'INV-2023-0007', 'Jhon', 1, 95000, 95000, 2, '2023-05-06 01:43:29', '2023-05-06 01:45:30', NULL, NULL, NULL, NULL),
	(9, 1, NULL, 'INV-2023-0008', 'Maria', 1, 15000, 15000, 2, '2023-05-06 01:45:14', '2023-05-06 01:45:24', NULL, NULL, NULL, NULL),
	(10, 1, NULL, 'INV-2023-0009', 'Cindy', 1, 70000, 70000, 2, '2023-05-09 18:00:00', '2023-05-09 12:15:36', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.transaction_details: ~26 rows (lebih kurang)
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `transaction_details` (`id`, `transactions_id`, `menus_id`, `discounts_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, 10000, 1, '2023-04-30 11:55:00', '2023-04-30 11:55:00'),
	(2, 1, 5, NULL, 5000, 1, '2023-04-30 11:55:00', '2023-04-30 11:55:00'),
	(3, 1, 8, NULL, 5000, 1, '2023-04-30 11:55:00', '2023-04-30 11:55:00'),
	(4, 2, 1, NULL, 10000, 2, '2023-04-30 11:59:26', '2023-04-30 11:59:26'),
	(5, 2, 3, NULL, 10000, 3, '2023-04-30 11:59:26', '2023-04-30 11:59:26'),
	(6, 2, 4, NULL, 5000, 2, '2023-04-30 11:59:26', '2023-04-30 11:59:26'),
	(7, 2, 5, NULL, 5000, 3, '2023-04-30 11:59:26', '2023-04-30 11:59:26'),
	(12, 4, 1, NULL, 10000, 4, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(13, 4, 2, NULL, 15000, 4, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(14, 4, 3, NULL, 10000, 4, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(15, 4, 7, NULL, 5000, 5, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(16, 4, 4, NULL, 5000, 5, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(17, 4, 5, NULL, 5000, 7, '2023-04-30 16:39:18', '2023-04-30 16:39:18'),
	(18, 5, 3, NULL, 10000, 1, '2023-04-30 17:01:47', '2023-04-30 17:01:47'),
	(19, 6, 1, NULL, 10000, 37, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(20, 6, 3, NULL, 10000, 29, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(21, 6, 4, NULL, 5000, 38, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(22, 6, 6, NULL, 10000, 40, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(23, 6, 2, NULL, 15000, 21, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(24, 6, 8, NULL, 5000, 14, '2023-05-05 08:30:20', '2023-05-05 08:30:20'),
	(25, 7, 2, NULL, 15000, 3, '2023-05-05 09:05:00', '2023-05-05 09:05:00'),
	(26, 7, 1, NULL, 10000, 3, '2023-05-05 09:05:00', '2023-05-05 09:05:00'),
	(27, 8, 1, NULL, 10000, 3, '2023-05-06 01:43:29', '2023-05-06 01:43:29'),
	(28, 8, 2, NULL, 15000, 3, '2023-05-06 01:43:29', '2023-05-06 01:43:29'),
	(29, 8, 9, NULL, 5000, 4, '2023-05-06 01:43:29', '2023-05-06 01:43:29'),
	(30, 9, 1, NULL, 10000, 1, '2023-05-06 01:45:14', '2023-05-06 01:45:14'),
	(31, 9, 4, NULL, 5000, 1, '2023-05-06 01:45:14', '2023-05-06 01:45:14'),
	(32, 10, 1, NULL, 10000, 2, '2023-05-09 18:00:00', '2023-05-09 12:15:29'),
	(33, 10, 2, NULL, 15000, 2, '2023-05-09 18:00:00', '2023-05-09 12:15:29'),
	(34, 10, 4, NULL, 5000, 4, '2023-05-09 18:00:00', '2023-05-09 12:15:29');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.users: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `fullname`, `email`, `email_verified_at`, `password`, `phone`, `sex`, `address`, `birth_date`, `profile_picture`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'Admin', 'Admin Admin', 'admin@mail.com', NULL, '$2y$10$LvLx6eF/pyNvsGYpD6WVyucvXgR8eOZQEfMu5BjrOwHhN56pMYnJS', '081515144981', 1, 'Sumber Sari, Jember', '2002-04-22', 'images/profile_picture/1682856358.jpg', 2, 1, NULL, '2023-04-30 03:27:48', '2023-05-02 00:38:24'),
	(2, 'Fahmi', 'Ubaidillah', 'Fahmi Ubaidillah', 'fahmi@mail.com', NULL, '$2y$10$yqFrmL72kKfNLS8t3f9vu..ARqYRPTSpPzhu5ZEau9e9iMZr0F6bS', '081515144984', 1, 'Olean, Situbondo', '2000-03-16', 'images/profile_picture/1682989417.jpg', 1, 1, NULL, '2023-04-30 12:10:14', '2023-05-02 01:03:37'),
	(4, 'Moh Ibnu', 'Abdurrohman Sutio', 'Moh Ibnu Abdurrohman Sutio', 'ibnu@mail.com', NULL, '$2y$10$ZBrStv6ImP4LFtbwpp3oIuH4VOQnnRpKM/GHbLKB82Mveohcda3VO', '08151514981', 1, 'Sumber Sari, Jember, Jawa Timur', '2002-04-22', NULL, 3, 1, NULL, '2023-05-06 23:19:54', '2023-05-06 23:19:54'),
	(5, 'Anindhyta', 'Akmala', 'Anindhyta Akmala', 'anin@mail.com', NULL, '$2y$10$HfCPNukhb9ZTLg.s8wiZ1uzFU0nM2aAzr.ysEu6uIdS9Ve7rJNV4q', '081515144983', 2, 'Sumber Sari, Jember, Jawa Timur', '2002-02-02', 'images/profile_picture/1683623063.jpg', 3, 1, NULL, '2023-05-06 23:21:32', '2023-05-09 16:21:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
