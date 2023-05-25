<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get()
    {
        return $this->user->get();
    }

    public function store($data)
    {
        $data['password']   = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['birth_date'] = date('Y-m-d', strtotime($data['birth_date']));
        $data['role']       = User::CASHIER_ROLE;
        $data['fullname']   = $data['first_name'] . ' ' . $data['last_name'];

        if (isset($data['profile_picture'])) {
            $filename = time() . '.' . $data['profile_picture']->getClientOriginalExtension();
            $data['profile_picture']->move(public_path('images/profile_picture'), $filename);
            $data['profile_picture'] = 'images/profile_picture/' . $filename;
        }

        return $this->user->create($data);
    }

    public function destroy($id)
    {
        return $this->user->find($id)->update(['active' => 0]);
    }

    public function update($id, $data)
    {
        // dd($data);
        $data['birth_date'] = date('Y-m-d', strtotime($data['birth_date']));
        $data['fullname']   = $data['first_name'] . ' ' . $data['last_name'];

        $user = $this->user->find($id);

        if (isset($data['profile_picture'])) {
            if ($user->profile_picture != null) {
                unlink(public_path($user->profile_picture));
            }

            $filename = time() . '.' . $data['profile_picture']->getClientOriginalExtension();
            $data['profile_picture']->move(public_path('images/profile_picture'), $filename);
            $data['profile_picture'] = 'images/profile_picture/' . $filename;
        }

        if (isset($data['password']) && $data['password'] != null) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }


        return $user->update($data);
    }
}
