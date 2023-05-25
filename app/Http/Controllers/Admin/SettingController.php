<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SettingInterface;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    private $setting;

    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.index', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->setting->update($request->all(), $id);
            return redirect()->back()->with('success', 'Profil berhasil diperbarui');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Profil gagal diperbarui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Custom Function
    public function passwordCheck(Request $request)
    {
        // return true;
        return $this->setting->passwordCheck($request->password) ? response()->json(['status' => true]) : response()->json(['status' => false]);
    }

    public function passwordUpdate(Request $request)
    {
        try {
            $this->setting->passwordUpdate($request->confirm_password);
            return redirect()->back()->with('success', 'Password berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Password gagal diperbarui');
        }
    }

    public function configurationStore()
    {
        return view('admin.setting.store.index', [
            'setting' => Setting::first()
        ]);
    }

    public function configurationStoreUpdate(Request $request)
    {
        try {
            $this->setting->configurationStoreUpdate($request->all());
            return redirect()->back()->with('success', 'Konfigurasi berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Konfigurasi gagal diperbarui');
        }
    }
}
