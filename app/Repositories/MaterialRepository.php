<?php

namespace App\Repositories;

use App\Interfaces\MaterialInterface;
use App\Models\MaterialTransaction;
use App\Models\MaterialTransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaterialRepository implements MaterialInterface
{
    private $materialTransaction;
    private $materialTransactionDetail;

    public function __construct(
        MaterialTransaction $materialTransaction,
        MaterialTransactionDetail $materialTransactionDetail
    ) {
        $this->materialTransaction          = $materialTransaction;
        $this->materialTransactionDetail    = $materialTransactionDetail;
    }

    public function store($data)
    {
        DB::beginTransaction();
        try {
            $materialTransaction = $this->materialTransaction->create([
                'transaction_code'  => uniqid('MT'),
                'total_paid'        => $data['total_paid'],
                'total_purchase'    => $data['total_purchase'],
                'suppliers'         => $data['suppliers'] ?? null,
                'user_id'           => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        try {
            foreach ($data['item'] as $material) {
                $this->materialTransactionDetail->create([
                    'material_transaction_id'   => $materialTransaction->id,
                    'name'                      => $material['name'] ?? null,
                    'unit_type'                 => $material['unit_type'] ?? null,
                    'quantity'                  => $material['quantity'] ?? null,
                    'ppu'                       => $material['ppu'] ?? null,
                    'total'                     => $material['total'] ?? null,
                    'status'                    => 0
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        DB::commit();
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        // delete removed item
        try {
            if(isset($data['removed_item'])) {
                foreach ($data['removed_item'] as $item) {
                    $this->materialTransactionDetail->find($item)->delete();
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        // update material transaction
        try {
            $materialTransaction = $this->materialTransaction->find($id);
            $materialTransaction->update([
                'total_paid'        => $data['total_paid'],
                'total_purchase'    => $data['total_purchase'],
                'suppliers'         => $data['suppliers'] ?? null,
                'user_id'           => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        // update material transaction detail
        try {
            foreach ($data['item'] as $material) {
                if (isset($material['id'])) {
                    $this->materialTransactionDetail->find($material['id'])->update([
                        'name'                      => $material['name'] ?? null,
                        'unit_type'                 => $material['unit_type'] ?? null,
                        'quantity'                  => $material['quantity'] ?? null,
                        'ppu'                       => $material['ppu'] ?? null,
                        'total'                     => $material['total'] ?? null,
                    ]);
                } else {
                    $this->materialTransactionDetail->create([
                        'material_transaction_id'   => $materialTransaction->id,
                        'name'                      => $material['name'] ?? null,
                        'unit_type'                 => $material['unit_type'] ?? null,
                        'quantity'                  => $material['quantity'] ?? null,
                        'ppu'                       => $material['ppu'] ?? null,
                        'total'                     => $material['total'] ?? null,
                        'status'                    => $material['status'] ?? '0'
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        DB::commit();
    }

    public function get()
    {
        return $this->materialTransaction->with(['materialTransactionDetail', 'user', 'cashier'])->get();
    }

    public function find($id)
    {
        return $this->materialTransaction->with('materialTransactionDetail')->find($id);
    }

    public function process($id)
    {
        $materialTransaction = $this->materialTransaction->find($id);
        $materialTransaction->update([
            'status' => 2
        ]);
    }

    public function confirmed($data, $id)
    {
        DB::beginTransaction();
        try {
            $materialTransaction      = $this->materialTransaction->find($id);

            if ($materialTransaction->purchase_proof) {
                Storage::delete('public/purchase_proof/' . $materialTransaction->purchase_proof);
            }

            $purchaseProof            = $data['purchase_proof'];
            $purchaseProofName        = time() . '_' . $purchaseProof->getClientOriginalName();
            $data['purchase_proof']->storeAs('public/purchase_proof', $purchaseProofName);
            $data['purchase_proof']   = $purchaseProofName;

            $materialTransaction->update([
                'status' => 3,
                'purchase_date' => date('Y-m-d'),
                'purchase_proof' => $data['purchase_proof'],
                'total_return' => $data['total_return'] ?? 0,
                'cashier_id' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        try {
            $item = json_decode($data['item'], true);
            foreach ($item as $material) {
                $this->materialTransactionDetail->find($material['id'])->update([
                    'status' => $material['status']
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        DB::commit();
    }
}
