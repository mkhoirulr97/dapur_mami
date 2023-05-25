<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationConfig;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReservationConfigController extends Controller
{

    public function index()
    {
        return view('admin.reservation-config.index', [
            'reservationConfig' => ReservationConfig::first(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'capacity' => 'required|min:1',
            'max_reservation_per_day' => 'required|min:1',
            'is_active' => 'required',
        ]);

        try {
            ReservationConfig::find($id)->update([
                'capacity' => $request->capacity,
                'max_reservation_per_day' => $request->max_reservation_per_day,
                'is_active' => $request->is_active,
            ]);

            return redirect()->route('admin.reservation-config.index')->with('success', 'Konfigurasi Reservasi Berhasil Diupdate');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('admin.reservation-config.index')->with('error', 'Konfigurasi Reservasi Gagal Diupdate');
        }
    }

    public function destroy(string $id)
    {
        //
    }

    // Custom Function

    public function check(Request $request)
    {
        $reservationConfig = ReservationConfig::first();
        $reservation = Transaction::where(
            [
                ['booking_date', date('Y-m-d', strtotime($request->booking_date))],
                ['status', 2],
            ]
        )->get();

        $maxBooking = $reservationConfig->max_booking;
        $totalBooking = count($reservation);

        // check if booking time is between open_at and close_at
        $setting = Setting::first();
        $open_at = date('H:i', strtotime($setting->open_at));
        $close_at = date('H:i', strtotime($setting->close_at));

        $isBetween = false;
        if (date('H:i', strtotime($request->booking_time)) >= $open_at && date('H:i', strtotime($request->booking_time)) <= $close_at) {
            $isBetween = true;
        }

        // check max booking
        $isMaxBooking = false;
        if ($totalBooking >= $maxBooking) {
            $isMaxBooking = true;
        }

        $totalGuest = 0;
        foreach ($reservation as $key => $value) {
            $totalGuest += $value->total_guest;
        }

        $remainingCapacity = $reservationConfig->capacity - $totalGuest;

        // check capacity
        $isFull = false;
        if ($request->total_guest > $remainingCapacity) {
            $isFull = true;
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'isAvailable' => $reservation->isEmpty() && date('Y-m-d', strtotime($request->booking_date)) != date('Y-m-d') ? true : false,
                'reservationConfig' => $reservationConfig,
                'reservation' => $reservation,
                'totalGuest' => $totalGuest,
                'isFull' => $isFull,
                'isMaxBooking' => $isMaxBooking,
                'remainingCapacity' => $remainingCapacity,
                'isBetween' => $isBetween,
            ],
        ]);
    }
}
