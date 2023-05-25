<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'fullname'   => ['required', 'string', 'max:255'],
            'sex'        => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'string', 'max:255'],
            'address'    => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password'   => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
        ]);

        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'fullname'   => $request->fullname,
                'sex'        => $request->sex,
                'birth_date' => date('Y-m-d', strtotime($request->birth_date)),
                'phone'      => $request->phone,
                'address'    => $request->address,
                'email'      => $request->email,
                'password'   => password_hash($request->password, PASSWORD_DEFAULT),
                'role'       => User::CUSTOMER_ROLE,
                'active'     => User::ACTIVE_STATUS,
            ]);

            event(new Registered($user));
            return redirect()->route('login')->with('success', 'Berhasil mendaftar, silahkan login');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal mendaftar');
        }
    }
}
