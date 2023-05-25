<?php

namespace App\Repositories;

use App\Interfaces\SettingInterface;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingRepository implements SettingInterface
{
    private $user;
    private $setting;

    public function __construct(User $user, Setting $setting)
    {
        $this->user = $user;
        $this->setting = $setting;
    }

    public function update(array $data, string $id): bool
    {
        $user = $this->user->find($id);

        if (isset($data['profile_picture'])) {
            if ($user->profile_picture) {
                $oldProfilePicture = public_path($user->profile_picture);
                if (file_exists($oldProfilePicture)) {
                    unlink($oldProfilePicture);
                }
            }

            $profilePicture     = $data['profile_picture'];
            $profilePictureName = time() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('images/profile_picture'), $profilePictureName);
            $user->profile_picture = 'images/profile_picture/' . $profilePictureName;
        }

        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->fullname   = $data['first_name'] . ' ' . $data['last_name'];
        $user->phone      = $data['phone'];
        $user->sex        = $data['sex'];
        $user->address    = $data['address'];
        $user->birth_date = date('Y-m-d', strtotime($data['birth_date']));

        return $user->save();
    }

    public function passwordCheck($password)
    {
        return app('hash')->check($password, auth()->user()->password);
    }

    public function passwordUpdate($password)
    {
        $user = $this->user->find(auth()->user()->id);
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        return $user->save();
    }

    public function configurationStoreUpdate($data)
    {
        $setting = $this->setting->first();
        $setting->update($data);
    }
}
