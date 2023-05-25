<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\MaterialInterface;
use App\Models\MaterialTransaction;
use App\Models\User;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    private $material;

    public function __construct(MaterialInterface $material)
    {
        $this->material = $material;
    }

    public function index(Request $request)
    {
        // $material = $this->material->get();
        // dd($material);
        if ($request->ajax()) {
            return datatables()
                ->of($this->material->get())
                ->addColumn('date', function ($data) {
                    return $data->created_at->translatedFormat('d F Y');
                })
                ->addColumn('total_paid', function ($data) {
                    return 'Rp. ' . number_format($data->total_paid, 0, ',', '.');
                })
                ->addColumn('total_return', function ($data) {
                    return 'Rp. ' . number_format($data->total_return, 0, ',', '.');
                })
                ->addColumn('total_purchase', function ($data) {
                    return 'Rp. ' . number_format($data->total_purchase, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return MaterialTransaction::STATUS[$data->status];
                })
                ->addColumn('supplier', function ($data) {
                    return $data->supplier ?? '-';
                })
                ->addColumn('user', function ($data) {
                    return $data->cashier->first_name ?? '-';
                })
                ->addColumn('purchase_date', function ($data) {
                    return $data->status == 1 ? '-' : date('d F Y', strtotime($data->purchase_date));
                })
                ->addColumn('purchase_proof', function ($data) {
                    return view('admin.material.column.purchase_proof', [
                        'data' => $data,
                    ]);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.material.column.action', [
                        'data' => $data,
                    ]);
                })
                ->addColumn('detail', function ($data) {
                    return view('admin.material.column.detail', [
                        'data' => $data->materialTransactionDetail,
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.material.index');
    }

    public function create()
    {
        return view('admin.material.create');
    }

    public function store(Request $request)
    {
        try {
            $this->material->store($request->all());
            return ['status' => true, 'message' => 'Pembelian berhasil ditambahkan'];
        } catch (\Throwable $th) {
            return ['status' => false, 'message' => $th->getMessage()];
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
    public function edit(string $id)
    {
        if (auth()->user()->role == 2) {
            return view('admin.material.edit', [
                'material' => $this->material->find($id)
            ]);
        } elseif (auth()->user()->role == 1) {
            return view('admin.material.cashier.edit', [
                'material' => $this->material->find($id)
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $this->material->update($request->all(), $id);
            return true;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy(string $id)
    {
        //
    }

    // Custom Function
    public function process($id)
    {
        try {
            $this->material->process($id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pembelian berhasil diproses'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function confirmed(Request $request, $id)
    {
        // dd($request->all());
        try {
            $this->material->confirmed($request->all(), $id);
            return response()->json([
                'status' => 'success',
                'message' => 'Pembelian berhasil dikonfirmasi'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
