<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->transactionToday())
                ->addColumn('customer', function ($data) {
                    return $data->customer_name ?? $data->event_name;
                })
                ->addColumn('menu', function ($data) {
                    return view('admin.dashboard.columns.menu', ['transactionDetails' => $data->transactionDetails]);
                })
                ->addColumn('invoice', function ($data) {
                    return $data->transaction_code;
                })
                ->addColumn('order_number', function ($data) {
                    return explode('-', $data->transaction_code)[2];
                })
                ->addColumn('total_payment', function ($data) {
                    return 'Rp. ' . number_format($data->total_payment, 0, ',', '.');
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y H:i');
                })
                ->addColumn('status', function ($data) {
                    return $data->status == 1 ? 'Menunggu' : ($data->status == 2 ? 'Selesai' : 'Dibatalkan');
                })
                ->addIndexColumn()
                ->make(true);
        }

        $date = Carbon::now()->isoFormat('dddd, D MMMM Y HH:mm') . ' WIB';

        return view('admin.dashboard.index', [
            'totalSalesHourly'     => $this->totalSalesHourly(app(Request::class)),
            'totalSalesTypeOfMenu' => $this->totalSalesTypeOfMenu(app(Request::class))['totalSalesTypeOfMenu'],
            'totalIncome'          => $this->totalSalesTypeOfMenu(app(Request::class))['totalIncome'],
            'totalOrder'           => $this->totalOrder()['totalOrder'],
            'totalOrderToday'      => $this->totalOrder()['totalOrderToday'],
            'totalCustomer'        => $this->totalCustomer()['totalCustomer'],
            'totalCustomerToday'   => $this->totalCustomer()['totalCustomerToday'],
            'favoriteMenu'         => $this->favoriteMenu(),
            'date'                 => $date
        ]);
    }

    // custom function
    public function totalSalesHourly(Request $request)
    {

        $sales1 = [];
        $sales2 = [];
        $sales3 = [];
        $sales4 = [];
        $sales5 = [];

        $transactions = TransactionDetail::all();

        if($request->type == 'day') {
            $transactions = TransactionDetail::whereDate('created_at', date('Y-m-d'))->get();
        }

        if($request->type == 'week') {
            $transactions = TransactionDetail::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        }

        if($request->type == 'month') {
            $transactions = TransactionDetail::whereMonth('created_at', date('m'))->get();
        }

        if($request->type == 'year') {
            $transactions = TransactionDetail::whereYear('created_at', date('Y'))->get();
        }

        foreach ($transactions as $transaction) {
            $time = $transaction->created_at->format('H:i');
            if ($time >= '17:00' && $time < '18:00') {
                $sales1[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            $time = $transaction->created_at->format('H:i');
            if ($time >= '18:00' && $time < '19:00') {
                $sales2[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            $time = $transaction->created_at->format('H:i');
            if ($time >= '19:00' && $time < '20:00') {
                $sales3[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            $time = $transaction->created_at->format('H:i');
            if ($time >= '20:00' && $time < '21:00') {
                $sales4[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            $time = $transaction->created_at->format('H:i');
            if ($time >= '21:00' && $time < '22:00') {
                $sales5[] = $transaction->quantity;
            }
        }

        $sales1 = array_sum($sales1);
        $sales2 = array_sum($sales2);
        $sales3 = array_sum($sales3);
        $sales4 = array_sum($sales4);
        $sales5 = array_sum($sales5);

        $totalSalesHourly = [
            $sales1, $sales2, $sales3, $sales4, $sales5
        ];

        return $totalSalesHourly;
    }

    public function totalSalesTypeOfMenu(Request $request)
    {
        $food = [];
        $drink = [];
        $snack = [];

        $transactions = TransactionDetail::all();
        $totalIncome = 0;

        if ($request->type == 'day') {
            $transactions = TransactionDetail::whereDate('created_at', date('Y-m-d'))->get();
            // get total income
            foreach ($transactions as $transaction) {
                $totalIncome += $transaction->quantity * $transaction->price;
            }
        } elseif ($request->type == 'week') {
            // get transaction of this week
            $transactions = TransactionDetail::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
            // get total income
            foreach ($transactions as $transaction) {
                $totalIncome += $transaction->quantity * $transaction->price;
            }
        } elseif ($request->type == 'month') {
            $transactions = TransactionDetail::whereMonth('created_at', date('m'))->get();
            // get total income
            foreach ($transactions as $transaction) {
                $totalIncome += $transaction->quantity * $transaction->price;
            }
        } elseif ($request->type == 'year') {
            $transactions = TransactionDetail::whereYear('created_at', date('Y'))->get();
            // get total income
            foreach ($transactions as $transaction) {
                $totalIncome += $transaction->quantity * $transaction->price;
            }
        } else {
            $transactions = TransactionDetail::all();
            // get total income
            foreach ($transactions as $transaction) {
                $totalIncome += $transaction->quantity * $transaction->price;
            }
        }

        foreach ($transactions as $transaction) {
            if ($transaction->menu->category == Menu::FOOD_CATEGORY) {
                $food[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            if ($transaction->menu->category == Menu::DRINK_CATEGORY) {
                $drink[] = $transaction->quantity;
            }
        }

        foreach ($transactions as $transaction) {
            if ($transaction->menu->category == Menu::SNACK_CATEGORY) {
                $snack[] = $transaction->quantity;
            }
        }

        $food = array_sum($food);
        $drink = array_sum($drink);
        $snack = array_sum($snack);

        $totalSalesTypeOfMenu = [
            $food, $drink, $snack
        ];

        return [
            'totalSalesTypeOfMenu' => $totalSalesTypeOfMenu,
            'totalIncome'          => $totalIncome
        ];
    }

    public function totalOrder()
    {
        $transactions = TransactionDetail::all();
        $totalOrder = 0;
        $totalOrderToday = 0;

        foreach ($transactions as $transaction) {
            $totalOrder += $transaction->quantity;
        }

        foreach ($transactions as $transaction) {
            if ($transaction->created_at->format('Y-m-d') == date('Y-m-d')) {
                $totalOrderToday += $transaction->quantity;
            }
        }

        return [
            'totalOrder'      => $totalOrder,
            'totalOrderToday' => $totalOrderToday
        ];
    }

    public function totalCustomer()
    {
        $transactions = Transaction::all();
        $totalOrder = $transactions->where('customer_name', '!=', null)->count();
        $totalGuestReservation = $transactions->where('customer_name', null)->sum('total_guest');
        $totalCustomer = $totalOrder + $totalGuestReservation;

        // get new customer today by count customer_name in transactions
        $totalCustomerToday = Transaction::whereDate('created_at', date('Y-m-d'))->where('customer_name', '!=', null)->count();
        $totalGuestReservationToday = Transaction::whereDate('created_at', date('Y-m-d'))->where('customer_name', null)->sum('total_guest');
        $totalCustomerToday = $totalCustomerToday + $totalGuestReservationToday;

        return [
            'totalCustomer' => $totalCustomer,
            'totalCustomerToday' => $totalCustomerToday
        ];
    }

    public function favoriteMenu()
    {
        // find favorite menu by count menus_id in transaction_details and sum quantity, make limit 5 menu
        $favoriteMenu = TransactionDetail::select('menus_id', DB::raw('sum(quantity) as total_quantity'))
            ->groupBy('menus_id')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // get menu detail
        foreach ($favoriteMenu as $menu) {
            $menu->menu = Menu::find($menu->menus_id);
        }

        return $favoriteMenu;
    }

    public function transactionToday()
    {
        $transactions = Transaction::with('transactionDetails')->whereDate('created_at', Carbon::today())->get();
        return $transactions;
    }
}
