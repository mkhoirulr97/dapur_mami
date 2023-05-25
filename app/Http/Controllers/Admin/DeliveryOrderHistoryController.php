<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DeliveryOrderInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryOrderHistoryController extends Controller
{
    private $deliveryOrder;

    /**
     * Create a new controller instance.
     */
    public function __construct(DeliveryOrderInterface $deliveryOrder)
    {
        $this->deliveryOrder = $deliveryOrder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->deliveryOrder->get())
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D MMMM Y HH:mm') . ' WIB';
                })
                ->addColumn('payment_proof', function($data) {
                    return view('admin.delivery-order-history.columns.payment_proof', [
                        'data' => $data->payment_proof
                    ]);
                })
                ->addColumn('invoice', function ($data) {
                    return $data->invoice;
                })
                ->addColumn('customer', function ($data) {
                    return $data->customer_name;
                })
                ->addColumn('phone', function ($data) {
                    $phone = $data->delivery_phone;
                    $phone = preg_replace('/^0/', '+62', $phone);
                    return $phone;
                })
                ->addColumn('address', function ($data) {
                    return $data->delivery_address;
                })
                ->addColumn('note', function ($data) {
                    return $data->delivery_note;
                })
                ->addColumn('product', function ($data) {
                    return view('admin.delivery-order-history.columns.product', [
                        'products' => $data->detailDeliveryOrders
                    ]);
                })
                ->addColumn('total', function ($data) {
                    return 'Rp. ' . number_format($data->total_payment, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return view('admin.delivery-order-history.columns.status', [
                        'data' => $data,
                    ]);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.delivery-order-history.columns.action', [
                        'data' => $data
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.delivery-order-history.index');
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
    public function changeStatus(Request $request)
    {
        try {
            $this->deliveryOrder->changeStatus($request->all());
            return response()->json([
                'status' => 'success',
                'message' => 'Status berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
