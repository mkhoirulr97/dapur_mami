<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CatalogManagementInterface;
use App\Models\Menu;
use Illuminate\Http\Request;

class CatalogManagementController extends Controller
{
    private $catalogManagement;

    public function __construct(CatalogManagementInterface $catalogManagement)
    {
        $this->catalogManagement = $catalogManagement;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->catalogManagement->get())
                ->addColumn('image', function ($data) {
                    return view('admin.menu.catalog_management.column.image', ['image' => $data->image]);
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('weight', function ($data) {
                    return $data->weight;
                })
                ->addColumn('price', function ($data) {
                    return number_format($data->price, 0, ',', '.');
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.menu.catalog_management.column.action', ['id' => $data->id]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.menu.catalog_management.index');
    }

    public function create()
    {
        return view('admin.menu.catalog_management.create', [
            'categories' => Menu::CATEGORIES
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'price'    => ['required'],
                'category' => ['required'],
                'weight'   => ['required'],
                'image'    => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ]);

            $this->catalogManagement->store($request->all());
            return redirect()->route('admin.catalog-management.index')->with('success', 'Menu berhasil ditambahkan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Menu gagal ditambahkan');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('admin.menu.catalog_management.edit', [
            'data'       => $this->catalogManagement->find($id),
            'categories' => Menu::CATEGORIES
        ]);
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'price'    => ['required'],
                'category' => ['required'],
                'weight'   => ['required'],
                'image'    => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            ], [
                'name.required'     => 'Nama menu tidak boleh kosong',
                'price.required'    => 'Harga menu tidak boleh kosong',
                'category.required' => 'Kategori menu tidak boleh kosong',
                'weight.required'   => 'Berat menu tidak boleh kosong',
                'image.mimes'       => 'Gambar menu harus berupa file gambar',
                'image.max'         => 'Ukuran gambar menu maksimal 2MB',
            ]);

            $this->catalogManagement->update($request->all(), $id);
            return redirect()->route('admin.catalog-management.index')->with('success', 'Menu berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->catalogManagement->destroy($id);
            return redirect()->back()->with('success', 'Menu berhasil dihapus');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Menu gagal dihapus');
        }
    }
}
