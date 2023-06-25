<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\InvoiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class InvoiceController extends Controller
{

    private $invoice;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoice = $invoice;
    }

    public function index()
    {
        return view('admin.invoice.index', [
            'invoices' => $this->invoice->get()->sortByDesc('created_at')
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
        try {
            $this->invoice->store($request->all());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = $this->invoice->show($id);
        return view('admin.invoice.component.detail-order', [
            'invoice' => $invoice,
            'totalItemOrder' => $invoice->transactionDetails->sum('quantity'),
        ])->render();
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

    // Custom function

    public function period(Request $request)
    {
        return view('admin.invoice.component.invoice-item', [
            'invoices' => $this->invoice->period($request->period) ?? []
        ])->render();
    }

    public function search(Request $request)
    {
        return view('admin.invoice.component.invoice-item', [
            'invoices' => $this->invoice->search($request->search) ?? []
        ])->render();
    }

    public function print($id)
    {
        $invoice = $this->invoice->show($id);
        return Pdf::loadView('admin.invoice.component.print', [
            'invoice' => $invoice,
            'totalItemOrder' => $invoice->transactionDetails->sum('quantity'),
        ])->setOption('page-size', 'B5')->setOption('margin-top', 0)->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0)->stream('invoice-' . $invoice->transaction_code . '.pdf');
    }

    public function detail($id)
    {
        return $this->invoice->show($id);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $this->invoice->updateStatus($id, $request->status);
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

    public function transactionHistory(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->invoice->getAll())
                ->addColumn('invoice', function ($data) {
                    return $data->transaction_code;
                })
                ->addColumn('customer', function ($data) {
                    return $data->customer_name ?? $data->event_name;
                })
                ->addColumn('menu', function ($data) {
                    return view('admin.invoice.columns.menu', [
                        'menus' => $data->transactionDetails
                    ]);
                })
                ->addColumn('quantity', function ($data) {
                    return view('admin.invoice.columns.quantity', [
                        'menus' => $data->transactionDetails
                    ]);
                })
                ->addColumn('total', function ($data) {
                    return 'Rp. ' . number_format($data->total_payment, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return view('admin.invoice.columns.status', [
                        'status' => $data->status
                    ]);
                })
                ->addColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->isoFormat('D/MM/Y H:mm') . ' WIB';
                })
                ->addColumn('user', function ($data) {
                    return $data->user->first_name;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.invoice.transaction-history', [
            'months' => [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ],
            'totalSales' => $this->invoice->getTotalSales(),
        ]);
    }

    public function filterByDateRange(Request $request)
    {
        $invoices = $this->invoice->filterByDateRange($request->start_date, $request->end_date);
        $invoices = $invoices->map(function ($invoice) {
            return [
                'invoice' => $invoice->transaction_code,
                'customer' => $invoice->customer_name ?? $invoice->event_name,
                'menu' => view('admin.invoice.columns.menu', [
                    'menus' => $invoice->transactionDetails
                ])->render(),
                'quantity' => view('admin.invoice.columns.quantity', [
                    'menus' => $invoice->transactionDetails
                ])->render(),
                'total' => 'Rp. ' . number_format($invoice->total_payment, 0, ',', '.'),
                'status' => view('admin.invoice.columns.status', [
                    'status' => $invoice->status
                ])->render(),
                'created_at' => Carbon::parse($invoice->created_at)->formatLocalized('%d %B %Y'),
                'user' => $invoice->user->first_name,
            ];
        });

        return response()->json($invoices);
    }
}
