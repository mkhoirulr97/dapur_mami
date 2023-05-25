<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function(BreadcrumbTrail $trail) {
    $trail->push('Halaman Utama', route('admin.dashboard'));
});

// Menu
Breadcrumbs::for('menu', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Makanan & Minuman', route('admin.menu.index'));
});

// Invoice
Breadcrumbs::for('invoice', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Tagihan', route('admin.invoice.index'));
});

Breadcrumbs::for('transaction-history', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Riwayat Pemesanan', route('admin.transaction-history'));
});

// Setting
Breadcrumbs::for('setting', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaturan', route('admin.setting.index'));
});

// Catalog Management
Breadcrumbs::for('catalog-management', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manajemen Menu', route('admin.catalog-management.index'));
});

// Catalog Management > Tambah Menu
Breadcrumbs::for('catalog-management.create', function(BreadcrumbTrail $trail) {
    $trail->parent('catalog-management');
    $trail->push('Tambah Menu', route('admin.catalog-management.create'));
});

// Catalog Management > Update Menu
Breadcrumbs::for('catalog-management.edit', function(BreadcrumbTrail $trail, $data) {
    $trail->parent('catalog-management');
    $trail->push($data->name, route('admin.catalog-management.edit', $data->id));
});

// Booking
Breadcrumbs::for('booking', function(BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Reservasi', route('admin.booking.index'));
});

// Booking > Tambah Booking
Breadcrumbs::for('booking.create', function(BreadcrumbTrail $trail) {
    $trail->parent('booking');
    $trail->push('Tambah Rerservasi', route('admin.booking.create'));
});

// Cashier
Breadcrumbs::for('cashier', function(BreadCrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manajemen Kasir', route('admin.cashier.index'));
});

// Cashier > Tambah Kasir
Breadcrumbs::for('cashier.create', function(BreadCrumbTrail $trail) {
    $trail->parent('cashier');
    $trail->push('Tambah Kasir', route('admin.cashier.create'));
});

// Cashier > Update Kasir
Breadcrumbs::for('cashier.edit', function(BreadCrumbTrail $trail, $data) {
    $trail->parent('cashier');
    $trail->push($data->fullname, route('admin.cashier.edit', $data->id));
});

// Material
Breadcrumbs::for('material', function(BreadCrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manajemen Bahan', route('admin.material.index'));
});

// Material > Tambah Bahan
Breadcrumbs::for('material.create', function(BreadCrumbTrail $trail) {
    $trail->parent('material');
    $trail->push('Tambah Bahan', route('admin.material.create'));
});

// Material > Edit Bahan
Breadcrumbs::for('material.edit', function(BreadCrumbTrail $trail, $data) {
    $trail->parent('material');
    $trail->push($data->transaction_code, route('admin.material.edit', $data->id));
});

// Reservation Config
Breadcrumbs::for('reservation-config', function(BreadCrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Konfigurasi Reservasi', route('admin.reservation-config.index'));
});

// Delivery Order History
Breadcrumbs::for('delivery-order-history', function(BreadCrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Riwayat Pengiriman', route('admin.delivery-order-history.index'));
});

// Setting Configuration Store
Breadcrumbs::for('setting.configuration-store', function(BreadCrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Konfigurasi Toko', route('admin.configuration-store'));
});
