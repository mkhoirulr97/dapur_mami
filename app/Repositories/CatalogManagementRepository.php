<?php

namespace App\Repositories;

use App\Interfaces\CatalogManagementInterface;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class CatalogManagementRepository implements CatalogManagementInterface
{
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function get()
    {
        return $this->menu->get();
    }

    public function store($data): bool
    {
        if (isset($data['image'])) {
            $filename = time() . '.' . $data['image']->getClientOriginalName();
            $data['image']->move(public_path('images/menu'), $filename);
            $data['image'] = 'images/menu/' . $filename;
        }

        $this->menu->create([
            'name'        => $data['name'],
            'price'       => $data['price'],
            'category'    => $data['category'],
            'weight'      => $data['weight'],
            'image'       => isset($data['image']) ? $data['image'] : null,
            'description' => $data['description'],
            'status'      => $this->menu::ACTIVE_STATUS
        ]);

        return true;
    }

    public function destroy($id): bool
    {
        $this->menu->where('id', $id)->update(['active' => $this->menu::INACTIVE_STATUS]);
        return true;
    }

    public function find($id)
    {
        return $this->menu->find($id);
    }

    public function update($data, $id): bool
    {
        try {
            $menu = $this->menu->find($id);

            if (isset($data['image'])) {
                if ($menu->image) {
                    $oldImage = public_path($menu->image);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }

                $image     = $data['image'];
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/menu'), $imageName);
                $menu->image = 'images/menu/' . $imageName;
            }

            $menu->name        = $data['name'];
            $menu->price       = $data['price'];
            $menu->category    = $data['category'];
            $menu->weight      = $data['weight'];
            $menu->description = $data['description'];

            $menu->save();

            return true;
        } catch (\Throwable $th) {
            if (isset($data['image'])) {
                $newImage = public_path($menu->image);
                if (file_exists($newImage)) {
                    unlink($newImage);
                }
            }

            return false;
        }
    }

    public function getMenuByCategory($id)
    {
        return $this->menu->where('category', $id)->get();
    }

    public function search($data)
    {
        // get quantity of menu in transaction detail
        $menu = $this->menu->withCount([
            'transactionDetails as sold' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }
        ])->where('name', 'like', '%' . $data . '%')->get();

        return $menu;
    }

    public function getWithTotalSales()
    {
        // get quantity of menu in transaction detail
        $menu = $this->menu->withCount([
            'transactionDetails as sold' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }
        ])->get();

        return $menu;
    }

    public function sortByPrice($value)
    {
        // get quantity of menu in transaction detail
        $menus = $this->menu->withCount([
            'transactionDetails as sold' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }
        ])->get();

        if($value == 'minmax') {
            $menus = $menus->sortBy('price');
        } elseif($value == 'maxmin') {
            $menus = $menus->sortByDesc('price');
        } else {
            $menus = $menus->sortBy('name');
        }

        return $menus;
    }

    public function sortByCategory($value)
    {
        $menus = $this->menu->withCount([
            'transactionDetails as sold' => function ($query) {
                $query->select(DB::raw('sum(quantity)'));
            }
        ])->get();
        return $value == 'all' ? $menus : $menus->where('category', $value);
    }
}
