<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewOrderEvent;
use App\Http\Controllers\Controller;
use App\Interfaces\DeliveryOrderInterface;
use App\Models\Setting;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    private $deliveryOrder;

    public function __construct(DeliveryOrderInterface $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    public function index()
    {
        return view('user.delivery-order.index', [
            'transactions' => $this->deliveryOrder->getByUserId(auth()->user()->id),
            'setting' => Setting::first()
        ]);
    }

    public function list()
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->getByUserId(auth()->user()->id)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice'           => ['required'],
            'customer_name'     => ['required'],
            'payment_method'    => ['required'],
            'total_payment'     => ['required'],
            'sub_total'         => ['required'],
            'delivery_address'  => ['required'],
            'delivery_note'     => ['required'],
            'delivery_phone'    => ['required']
        ]);

        try {
            $this->deliveryOrder->store($request->all());
            event(new NewOrderEvent($request->invoice));
            return response()->json([
                'status'    => 'success',
                'message'   => 'Pemesanan berhasil dilakukan!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => 'error',
                'message'   => $th->getMessage()
            ]);
        }
    }

    public function show(string $id)
    {
        return response()->json($this->deliveryOrder->find($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Custom Function
    public function search(Request $request)
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->search($request->keyword)
        ])->render();
    }

    public function filterByStatus(Request $request)
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->filterByStatus($request->status)
        ])->render();
    }

    public function filterByRangeDate(Request $request)
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->filterByRangeDate($request->start_date, $request->end_date)
        ])->render();
    }

    public function filterByPeriod(Request $request)
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->filterByPeriod($request->period)
        ])->render();
    }

    public function filterBySortBy(Request $request)
    {
        return view('user.delivery-order.component.order-item', [
            'transactions' => $this->deliveryOrder->filterBySortBy($request->sort_by)
        ])->render();
    }

    public function confirmPayment(Request $request)
    {
        try {
            $this->deliveryOrder->confirmPayment($request->id, $request->proof);
            return response()->json([
                'status'    => 'success',
                'message'   => 'Konfirmasi pembayaran berhasil dilakukan!'
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function cancelOrder(Request $request)
    {
        try {
            $this->deliveryOrder->cancelOrder($request->id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dibatalkan!'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
