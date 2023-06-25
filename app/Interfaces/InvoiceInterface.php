<?php

namespace App\Interfaces;

interface InvoiceInterface {
    public function get();
    public function store($data);
    public function period($data);
    public function show($id);
    public function search($data);
    public function updateStatus($id, $data);
    public function getAll();
    public function filterByMonth($month);
    public function filterByDateRange($start, $end);
    public function getTotalSales();
}
