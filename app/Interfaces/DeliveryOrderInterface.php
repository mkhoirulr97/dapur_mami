<?php

namespace App\Interfaces;

interface DeliveryOrderInterface {

    public function getByUserId($userId);
    public function store($data);
    public function find($id);
    public function search($keyword);
    public function filterByStatus($status);
    public function filterByRangeDate($startDate, $endDate);
    public function filterByPeriod($period);
    public function filterBySortBy($sort);
    public function confirmPayment($id, $proof);
    public function cancelOrder($id);

    // Delivery Order History
    public function get();
    public function changeStatus($data);
}
