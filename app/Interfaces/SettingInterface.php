<?php

namespace App\Interfaces;

interface SettingInterface
{
    public function update(array $data, string $id): bool;
    public function passwordCheck($password);
    public function passwordUpdate($password);
    public function configurationStoreUpdate($data);
}
