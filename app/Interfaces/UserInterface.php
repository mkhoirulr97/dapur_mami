<?php

namespace App\Interfaces;

interface UserInterface
{
    public function get();
    public function store($data);
    public function destroy($id);
    public function update($id, $data);
}
