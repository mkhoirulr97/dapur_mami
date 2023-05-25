<?php

namespace App\Interfaces;

interface BookingInterface {
    public function get();
    public function store($data);
    public function find($id);
    public function period($data);
    public function updateStatus($id, $status);
    public function cancel($id);
}
