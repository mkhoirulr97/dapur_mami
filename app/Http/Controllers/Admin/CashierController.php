<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    private $user;

    public function __construct(UserInterface $user) {
        $this->user = $user;
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()
            ->of($this->user->get()->where('role', User::CASHIER_ROLE))
            ->addColumn('fullname', function($data) {
                return view('admin.cashier.columns.name', ['data' => $data]);
            })
            ->addColumn('email', function($data) {
                return $data->email;
            })
            ->addColumn('sex', function($data) {
                return $data->sex == 1 ? 'Laki-laki' : 'Perempuan';
            })
            ->addColumn('phone', function($data) {
                return $data->phone;
            })
            ->addColumn('address', function($data) {
                return $data->address;
            })
            ->addColumn('action', function($data) {
                return view('admin.cashier.columns.action', ['data' => $data]);
            })
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.cashier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cashier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'min:6'],
            'sex'        => ['required', 'numeric'],
            'phone'      => ['required'],
            'birth_date' => ['required'],
            'address'    => ['required'],
        ]);

        try {
            $this->user->store($request->all());
            return redirect()->route('admin.cashier.index')->with('success', 'Berhasil menambahkan kasir baru');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan kasir baru');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.cashier.edit', [
            'cashier' => $this->user->get()->where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'sex'        => ['required', 'numeric'],
            'phone'      => ['required'],
            'birth_date' => ['required'],
            'address'    => ['required'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        try {
            $this->user->update($id, $request->all());
            return redirect()->route('admin.cashier.index')->with('success', 'Berhasil mengubah kasir');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah kasir');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->user->destroy($id);
            return redirect()->route('admin.cashier.index')->with('success', 'Berhasil menghapus kasir');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus kasir');
        }
    }
}
