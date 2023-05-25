<?php

namespace App\Interfaces;

interface MaterialInterface
{
    public function get();
    public function find($id);
    public function store($data);
    public function update($data, $id);
    public function process($id);
    public function confirmed($data, $id);
}
