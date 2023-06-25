<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\CatalogManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryOrderController;
use App\Http\Controllers\Admin\DeliveryOrderHistoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationConfigController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserSettingController;
use Illuminate\Support\Facades\Route;


Route::get('login', function () {
    return view('auth.login');
})->name('login');

// Forgot Password
Route::group(['prefix' => 'forgot-password'], function () {
    Route::get('/', [ForgetPasswordController::class, 'index'])->name('forgot-password');
    Route::post('/', [ForgetPasswordController::class, 'sendResetLinkEmail'])->name('forgot-password');
    Route::get('/reset/{token}', [ForgetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [ForgetPasswordController::class, 'reset'])->name('password.update');
});

// Menu
Route::get('menu/add-cart/{id}', [HomeController::class, 'addCart'])->name('user.menu.add-cart');
Route::get('menu/sort-by-category', [HomeController::class, 'sortByCategory'])->name('user.menu.sort-by-category');
Route::get('menu/sort-by-price', [HomeController::class, 'sortByPrice'])->name('user.menu.sort-by-price');
Route::get('menu/search', [HomeController::class, 'search'])->name('user.menu.search');
Route::get('menu', [HomeController::class, 'menu'])->name('user.menu');
Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    // Delivery Order
    Route::post('delivery-order/confirm-payment', [DeliveryOrderController::class, 'confirmPayment'])->name('admin.delivery-order.confirm-payment');
    Route::post('delivery-order/cancel-order', [DeliveryOrderController::class, 'cancelOrder'])->name('admin.delivery-order.cancel-order');
    Route::get('delivery-order/list', [DeliveryOrderController::class, 'list'])->name('admin.delivery-order.list');
    Route::get('delivery-order/filter/sort-by', [DeliveryOrderController::class, 'filterBySortBy'])->name('admin.delivery-order.filter.sort-by');
    Route::get('delivery-order/filter/period', [DeliveryOrderController::class, 'filterByPeriod'])->name('admin.delivery-order.filter.period');
    Route::get('delivery-order/filter/range-date', [DeliveryOrderController::class, 'filterByRangeDate'])->name('admin.delivery-order.filter.range-date');
    Route::get('delivery-order/filter/status', [DeliveryOrderController::class, 'filterByStatus'])->name('admin.delivery-order.filter.status');
    Route::get('delivery-order/search', [DeliveryOrderController::class, 'search'])->name('admin.delivery-order.search');
    Route::resource('delivery-order', DeliveryOrderController::class, ['as' => 'admin']);

    // User Setting
    Route::post('user-setting/password/update', [SettingController::class, 'passwordUpdate'])->name('user.setting.password.update');
    Route::post('user-setting/password/check', [SettingController::class, 'passwordCheck'])->name('user.setting.password.check');
    Route::resource('user-setting', UserSettingController::class, ['as' => 'user']);

    // Dashboard
    Route::middleware(['admin.access'])->group(function () {
        Route::get('/total-sales-hourly', [DashboardController::class, 'totalSalesHourly'])->name('dashboard.total-sales-hourly');
        Route::get('/total-sales-type-of-menu', [DashboardController::class, 'totalSalesTypeOfMenu'])->name('dashboard.total-sales-type-of-menu');
        Route::get('/', DashboardController::class)->name('admin.dashboard');

        // Delivery Order History
        Route::post('delivery-order-history/status/change', [DeliveryOrderHistoryController::class, 'changeStatus'])->name('admin.delivery-order-history.status.change');
        Route::resource('delivery-order-history', DeliveryOrderHistoryController::class, ['as' => 'admin']);

        // Menu
        Route::get('menu/search', [MenuController::class, 'search'])->name('admin.menu.search');
        Route::get('menu/category/{id}', [MenuController::class, 'category'])->name('admin.menu.category');
        Route::resource('menu', MenuController::class, ['as' => 'admin']);

        // Invoice
        Route::get('invoice/transaction-history/filter/date-range', [InvoiceController::class, 'filterByDateRange'])->name('admin.transaction-history.filter.date-range');
        Route::get('invoice/transaction-history/filter/by-month', [InvoiceController::class, 'filterByMonth'])->name('admin.transaction-history.filter.by-month');
        Route::get('invoice/transaction-history/export', [InvoiceController::class, 'export'])->name('admin.transaction-history.export');
        Route::get('invoice/transaction-history', [InvoiceController::class, 'transactionHistory'])->name('admin.transaction-history');
        Route::post('invoice/update-status/{id}', [InvoiceController::class, 'updateStatus'])->name('admin.invoice.update-status');
        Route::get('invoice/detail/{id}', [InvoiceController::class, 'detail'])->name('admin.invoice.detail');
        Route::get('invoice/print/{id}', [InvoiceController::class, 'print'])->name('admin.invoice.print');
        Route::get('invoice/search', [InvoiceController::class, 'search'])->name('admin.invoice.search');
        Route::get('invoice/period', [InvoiceController::class, 'period'])->name('admin.invoice.period');
        Route::resource('invoice', InvoiceController::class, ['as' => 'admin']);

        // Setting
        Route::post('setting/configruration-store/update', [SettingController::class, 'configurationStoreUpdate'])->name('admin.configuration-store.update');
        Route::get('setting/configuration-store', [SettingController::class, 'configurationStore'])->name('admin.configuration-store');
        Route::post('setting/password/update', [SettingController::class, 'passwordUpdate'])->name('admin.setting.password.update');
        Route::post('setting/password/check', [SettingController::class, 'passwordCheck'])->name('admin.setting.password.check');
        Route::resource('setting', SettingController::class, ['as' => 'admin']);

        // Catalog Management
        Route::resource('catalog-management', CatalogManagementController::class, ['as' => 'admin']);

        // Booking
        Route::post('booking/cancel/{id}', [BookingController::class, 'cancel'])->name('admin.booking.cancel');
        Route::post('booking/update-status/{id}', [BookingController::class, 'updateStatus'])->name('admin.booking.update-status');
        Route::get('booking/period', [BookingController::class, 'period'])->name('admin.booking.period');
        Route::get('booking/print/{id}', [BookingController::class, 'print'])->name('admin.booking.print');
        Route::get('booking/detail/{id}', [BookingController::class, 'detail'])->name('admin.booking.detail');
        Route::post('booking/add-cart/{id}', [BookingController::class, 'addCart'])->name('admin.booking.add-cart');
        Route::resource('booking', BookingController::class, ['as' => 'admin']);

        // Cashier
        Route::resource('cashier', CashierController::class, ['as' => 'admin']);

        // Material
        Route::post('material/confirmed/{id}', [MaterialController::class, 'confirmed'])->name('admin.material.confirmed');
        Route::post('material/process/{id}', [MaterialController::class, 'process'])->name('admin.material.process');
        Route::resource('material', MaterialController::class, ['as' => 'admin']);

        // Reservation Config
        Route::post('reservation-config/check', [ReservationConfigController::class, 'check'])->name('admin.reservation-config.check');
        Route::resource('reservation-config', ReservationConfigController::class, ['as' => 'admin']);
    });
});

require __DIR__ . '/auth.php';
