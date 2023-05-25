<?php

namespace App\Interfaces;

interface CatalogManagementInterface {
    public function get();
    public function find($id);
    public function store($data) :bool;
    public function destroy($id) :bool;
    public function update($data,$id) :bool;
    public function getMenuByCategory($id);
    public function search($data);
    public function getWithTotalSales();
    public function sortByPrice($value);
    public function sortByCategory($value);
}
