<?php

namespace App\Repositories;

use App\Interfaces\DeliveryOrderInterface;
use App\Models\DeliveryOrder;
use App\Models\DetailDeliveryOrder;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeliveryOrderRepository implements DeliveryOrderInterface
{
    private $deliveryOrder;
    private $detailDeliveryOrder;

    public function __construct(DeliveryOrder $deliveryOrder, DetailDeliveryOrder $detailDeliveryOrder)
    {
        $this->deliveryOrder          = $deliveryOrder;
        $this->detailDeliveryOrder    = $detailDeliveryOrder;
    }

    public function store($data)
    {
        $delivery_time = Carbon::now()->toTimeString();
        $delivery_date = date('Y-m-d');

        DB::beginTransaction();

        // insert to delivery_orders table
        try {
            $deliveryOrder = $this->deliveryOrder->create([
                'users_id'          => auth()->user()->id,
                'invoice'           => $data['invoice'],
                'customer_name'     => $data['customer_name'],
                'payment_method'    => $data['payment_method'],
                'total_payment'     => $data['total_payment'],
                'sub_total'         => $data['sub_total'],
                'delivery_time'     => $delivery_time,
                'delivery_date'     => $delivery_date,
                'delivery_address'  => $data['delivery_address'],
                'delivery_phone'    => $data['delivery_phone'],
                'delivery_note'     => $data['delivery_note'],
                'expired_at'        => Carbon::now()->addHours(2)
            ]);
        } catch (Exception $e) {
            throw $e;
            DB::rollback();
        }

        // insert to detail_delivery_orders table
        try {
            foreach ($data['cart'] as $cart) {
                $this->detailDeliveryOrder->create([
                    'delivery_orders_id'    => $deliveryOrder->id,
                    'menu_id'               => $cart['id'],
                    'price'                 => $cart['price'],
                    'quantity'              => $cart['quantity'],
                    'total'                 => $cart['total']
                ]);
            }
        } catch (Exception $e) {
            throw $e;
            DB::rollback();
        }

        DB::commit();
    }

    public function getByUserId($userId)
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->where('users_id', $userId)->orderBy('created_at', 'desc')->get();
    }


    public function find($id)
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->find($id);
    }

    public function search($keyword)
    {
        $deliveryOrder = $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->where('invoice', 'like', "%$keyword%")->get();

        return $deliveryOrder;
    }

    public function filterByStatus($status)
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])
            ->when($status == 0, function ($query) {
                return $query->where([
                    ['status', 0],
                    ['payment_at', null]
                ]);
            })
            ->when($status == '0t', function ($query) {
                return $query->where([
                    ['status', 0],
                    ['payment_at', '!=', null]
                ]);
            })
            ->when($status == 1, function ($query) {
                return $query->where('status', 1);
            })

            ->when($status == 2, function ($query) {
                return $query->where('status', 2);
            })
            ->when($status == 3, function ($query) {
                return $query->where('status', 3);
            })
            ->when($status == 4, function ($query) {
                return $query->where('status', 4);
            })
            ->get();
    }

    public function filterByRangeDate($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate)->format('Y-m-d');
        $endDate = Carbon::parse($endDate)->format('Y-m-d');
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->whereBetween('delivery_date', [$startDate, $endDate])->get();
    }

    public function filterByPeriod($period)
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])
            ->when($period == 'today', function ($query) {
                return $query->whereDate('delivery_date', Carbon::today());
            })
            ->when($period == 'yesterday', function ($query) {
                return $query->whereDate('delivery_date', Carbon::yesterday());
            })
            ->when($period == 'last_week', function ($query) {
                return $query->whereBetween('delivery_date', [Carbon::now()->subDays(7), Carbon::now()]);
            })
            ->when($period == 'last_thirty_days', function ($query) {
                return $query->whereBetween('delivery_date', [Carbon::now()->subDays(30), Carbon::now()]);
            })
            ->when($period == 'this_month', function ($query) {
                return $query->whereMonth('delivery_date', Carbon::now()->month);
            })
            ->when($period == 'this_year', function ($query) {
                return $query->whereYear('delivery_date', Carbon::now()->year);
            })
            ->get();
    }

    public function filterBySortBy($sort)
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->orderBy('created_at', $sort)->get();
    }

    public function confirmPayment($id, $proof)
    {
        $deliveryOrder = $this->deliveryOrder->find($id);
        if ($deliveryOrder->proof_payment != null) {
            Storage::delete($deliveryOrder->proof_payment);
        }

        $filename = $deliveryOrder->invoice . '-' . $proof->getClientOriginalName();
        $path = $proof->storeAs('public/payment_proof', $filename);

        $deliveryOrder->update([
            'payment_proof' => $filename,
            'payment_at'    => Carbon::now(),
        ]);
    }

    public function cancelOrder($id)
    {
        $this->deliveryOrder->find($id)->update([
            'status' => DeliveryOrder::STATUS_CANCELED
        ]);
    }

    public function get()
    {
        return $this->deliveryOrder->with(['detailDeliveryOrders', 'user'])->orderBy('created_at', 'desc')->get();
    }

    public function changeStatus($data)
    {
        $deliveryOrder = $this->deliveryOrder->find($data['id']);
        $deliveryOrder->update([
            'status' => $data['status']
        ]);
    }
}
