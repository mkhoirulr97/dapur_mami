<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\BookingInterface;
use App\Interfaces\CatalogManagementInterface;
use App\Models\ReservationConfig;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class BookingController extends Controller
{
    private $catalogMenu;
    private $booking;

    public function __construct(CatalogManagementInterface $catalogMenu, BookingInterface $booking)
    {
        $this->catalogMenu = $catalogMenu;
        $this->booking = $booking;
    }

    public function index()
    {
        return view('admin.booking.index', [
            'bookings' => $this->booking->get(),
            'bookingStatus' => ReservationConfig::first()->is_active
        ]);
    }

    public function create()
    {
        return view('admin.booking.create', [
            'menus' => $this->catalogMenu->get()
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->booking->store($request->all());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function show($id)
    {
        return $this->booking->find($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    // Custom function

    public function addCart($id)
    {
        $menu = $this->catalogMenu->find($id);
        return view('admin.booking.component.menu-item', [
            'menu' => $menu
        ])->render();
    }

    public function detail($id)
    {
        return view('admin.booking.component.detail-order', [
            'booking' => $this->booking->find($id)
        ])->render();
    }

    public function print($id)
    {
        // dd($this->booking->find($id));
        $booking = $this->booking->find($id);
        return Pdf::loadView('admin.booking.component.print', [
            'booking'        => $booking,
            'totalItemOrder' => $booking->transactionDetails->sum('quantity'),
        ])->setOption('page-size', 'B5')->setOption('margin-top', 0)->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0)->stream('booking-' . $booking->transaction_code . '.pdf');
    }

    public function period(Request $request)
    {
        $bookings = $this->booking->period($request->period);
        return view('admin.booking.component.list-booking', [
            'bookings' => $bookings
        ])->render();
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->booking->updateStatus($id, $request->status);
            return response()->json([
                'status' => true,
                'message' => 'Status berhasil diubah'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function cancel($id)
    {
        try {
            $this->booking->cancel($id);
            return response()->json([
                'status' => true,
                'message' => 'Booking berhasil dibatalkan'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
