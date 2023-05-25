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

-- Membuang data untuk tabel dapur_mami.discounts: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.discount_menus: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `discount_menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_menus` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.failed_jobs: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.material_transactions: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `material_transactions` DISABLE KEYS */;
INSERT IGNORE INTO `material_transactions` (`id`, `transaction_code`, `total_paid`, `total_return`, `total_purchase`, `status`, `suppliers`, `purchase_note`, `purchase_proof`, `purchase_date`, `user_id`, `created_at`, `updated_at`) VALUES
	(18, 'MT642edd6dbcc76', 20000, 12000, 12000, 3, NULL, NULL, '1682815854_WhatsApp Image 2023-04-29 at 08.40.17.jpeg', '2023-04-30', 1, '2023-04-06 14:55:41', '2023-04-30 00:50:54'),
	(20, 'MT644dc00429a64', 50000, 3000, 22000, 3, NULL, NULL, '1682817571_David Camposi.jpg', '2023-04-30', 1, '2023-04-30 01:10:28', '2023-04-30 01:19:31');
/*!40000 ALTER TABLE `material_transactions` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.material_transaction_details: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `material_transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `material_transaction_details` (`id`, `material_transaction_id`, `name`, `unit_type`, `quantity`, `ppu`, `total`, `status`, `created_at`, `updated_at`) VALUES
	(1, 18, 'Beras', 'kg', 2, 1000, 2000, 2, '2023-04-06 14:55:41', '2023-04-30 00:50:54'),
	(2, 18, 'Gula', 'l', 2, 2000, 4000, 2, '2023-04-06 14:55:41', '2023-04-30 00:50:54'),
	(8, 18, 'Garam', 'kg', 3, 2000, 6000, 1, '2023-04-29 22:21:14', '2023-04-29 22:28:28'),
	(9, 20, 'Minyak', 'l', 1, 12000, 12000, 1, '2023-04-30 01:10:28', '2023-04-30 01:19:12'),
	(11, 20, 'Gula', 'kg', 1, 10000, 10000, 1, '2023-04-30 01:15:14', '2023-04-30 01:19:31');
/*!40000 ALTER TABLE `material_transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.menus: ~9 rows (lebih kurang)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT IGNORE INTO `menus` (`id`, `name`, `price`, `category`, `description`, `weight`, `discounts_id`, `active`, `created_at`, `updated_at`, `image`) VALUES
	(1, 'Nasi Goreng', 10000, 1, 'Nasi goreng dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(2, 'Nasi Goreng Spesial', 15000, 1, 'Nasi goreng dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(3, 'Soto Ayam', 10000, 1, 'Soto ayam dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(4, 'Es Teh', 5000, 2, 'Es teh dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(5, 'Es Jeruk', 5000, 2, 'Es jeruk dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(6, 'Es Campur', 10000, 2, 'Es campur dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(7, 'Keripik', 5000, 3, 'Keripik dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(8, 'Keripik Kacang', 5000, 3, 'Keripik kacang dengan bumbu khas Indonesia', 100, NULL, 1, NULL, NULL, NULL),
	(9, 'Keripik Tempe', 5000, 3, 'Keripik tempe dengan bumbu khas Indonesia', 100, NULL, 1, NULL, '2023-03-02 03:43:32', NULL),
	(10, 'Es Teler', 5000, 2, 'safsd', 50, NULL, 1, '2023-03-20 13:46:32', '2023-03-20 13:46:51', NULL);
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.migrations: ~12 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT IGNORE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(12, '2014_10_12_000000_create_users_table', 1),
	(13, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(14, '2019_08_19_000000_create_failed_jobs_table', 1),
	(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(16, '2023_02_22_160644_create_discounts_table', 1),
	(17, '2023_02_22_160850_create_menus_table', 1),
	(18, '2023_02_22_221553_create_discount_menus_table', 1),
	(19, '2023_02_22_221935_create_transactions_table', 1),
	(20, '2023_02_26_141357_add_image_menu', 1),
	(21, '2023_03_01_103145_create_transaction_details_table', 1),
	(22, '2023_03_01_110657_add_relation_transactions_transaction_details', 1),
	(23, '2023_03_02_222145_delete_column_transaction_details', 2),
	(24, '2023_03_02_223859_remove_amount_item_transaction_details', 3),
	(25, '2023_03_03_095714_remove_total_price_transaction_details', 4),
	(26, '2023_03_04_114056_add_sub_total_transactions', 5),
	(27, '2023_03_05_044002_add_some_columns_transactions', 6),
	(28, '2023_03_05_044915_update_customer_name_transactions', 7),
	(29, '2023_04_03_034506_material_transactions_table', 8),
	(30, '2023_04_03_034841_material_transaction_details_table', 9),
	(31, '2023_04_06_070133_update_unit_type_column_material_transaction_details', 10),
	(32, '2023_04_06_075824_update_some_columns_material_transaction', 11),
	(33, '2023_04_29_232355_add_purchase_note_and_puchase_proof_material_transaction_table', 12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.password_reset_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.personal_access_tokens: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.transactions: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT IGNORE INTO `transactions` (`id`, `users_id`, `discounts_id`, `transaction_code`, `customer_name`, `payment_method`, `total_payment`, `sub_total`, `status`, `created_at`, `updated_at`, `event_name`, `total_guest`, `booking_date`, `booking_time`) VALUES
	(20, 1, NULL, 'INV-2023-0001', 'Ibnu', 1, 65000, 65000, 2, '2023-03-24 01:01:56', '2023-04-05 09:05:32', NULL, NULL, NULL, NULL),
	(21, 1, NULL, 'INV-2023-0002', 'Ibnu', 1, 65000, 65000, 1, '2023-03-24 01:01:57', '2023-03-24 01:01:57', NULL, NULL, NULL, NULL),
	(22, 1, NULL, 'INV-2023-0003', 'Hera', 1, 20000, 20000, 2, '2023-04-03 03:00:08', '2023-04-03 03:00:17', NULL, NULL, NULL, NULL),
	(23, 1, NULL, 'INV-2023-0004', 'Fahiim', 1, 45000, 45000, 3, '2023-04-05 09:05:01', '2023-04-06 05:48:21', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.transaction_details: ~13 rows (lebih kurang)
/*!40000 ALTER TABLE `transaction_details` DISABLE KEYS */;
INSERT IGNORE INTO `transaction_details` (`id`, `transactions_id`, `menus_id`, `discounts_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
	(48, 20, 1, NULL, 10000, 2, '2023-03-24 01:01:56', '2023-03-24 01:01:56'),
	(49, 20, 2, NULL, 15000, 2, '2023-03-24 01:01:56', '2023-03-24 01:01:56'),
	(50, 20, 3, NULL, 10000, 1, '2023-03-24 01:01:56', '2023-03-24 01:01:56'),
	(51, 20, 4, NULL, 5000, 1, '2023-03-24 01:01:56', '2023-03-24 01:01:56'),
	(52, 21, 1, NULL, 10000, 2, '2023-03-24 01:01:57', '2023-03-24 01:01:57'),
	(53, 21, 2, NULL, 15000, 2, '2023-03-24 01:01:57', '2023-03-24 01:01:57'),
	(54, 21, 3, NULL, 10000, 1, '2023-03-24 01:01:57', '2023-03-24 01:01:57'),
	(55, 21, 4, NULL, 5000, 1, '2023-03-24 01:01:57', '2023-03-24 01:01:57'),
	(56, 22, 8, NULL, 5000, 2, '2023-04-03 03:00:08', '2023-04-03 03:00:08'),
	(57, 22, 9, NULL, 5000, 2, '2023-04-03 03:00:08', '2023-04-03 03:00:08'),
	(58, 23, 3, NULL, 10000, 2, '2023-04-05 09:05:01', '2023-04-05 09:05:01'),
	(59, 23, 2, NULL, 15000, 1, '2023-04-05 09:05:01', '2023-04-05 09:05:01'),
	(60, 23, 4, NULL, 5000, 2, '2023-04-05 09:05:01', '2023-04-05 09:05:01');
/*!40000 ALTER TABLE `transaction_details` ENABLE KEYS */;

-- Membuang data untuk tabel dapur_mami.users: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `first_name`, `last_name`, `fullname`, `email`, `email_verified_at`, `password`, `phone`, `sex`, `address`, `birth_date`, `profile_picture`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Moh Ibnu', 'Abdurrohman Sutio', 'Moh Ibnu Abdurrohman Sutio', 'ibnu@mail.com', NULL, '$2y$10$MZDRtflFdYsiVUi6ZcEm4OJrEQifJesRzHjzrAzUp6utleYCpowlu', '081515144981', 1, 'Gending, Probolinggo', '2002-04-22', 'images/profile_picture/1678509909.png', 2, 1, NULL, '2023-03-02 03:40:53', '2023-03-11 04:45:09'),
	(2, 'Jhon', 'Doe', 'Jhon Doe', 'jhon@gmail.com', NULL, '$2y$10$DRtkQLR7DCy5hCb32os.buy0jnwYeXgQQmVJ.LYoo34z2Aziq9Op.', '081515133918', 1, 'Situbondo', '2023-03-11', 'images/profile_picture/1679196133.jpg', 1, 1, NULL, '2023-03-19 02:56:45', '2023-03-19 03:22:41'),
	(3, 'Muhammad', 'Khoirul Rosikin', 'Muhammad Khoirul Rosikin', 'khoirul@gmail.com', NULL, '$2y$10$UvWIJKV/dSDHjNwSScss0.z0WXiD/UdkzpAu4SLMINu5YF0KBlnJS', '085808241204', 1, 'Jember', '2002-07-09', 'images/profile_picture/1680491252.png', 1, 1, NULL, '2023-03-20 13:38:16', '2023-04-03 03:07:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
