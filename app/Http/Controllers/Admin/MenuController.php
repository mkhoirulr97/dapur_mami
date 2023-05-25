<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CatalogManagementInterface;
use App\Models\Menu;
use Illuminate\Http\Request;
use Termwind\Components\Raw;

class MenuController extends Controller
{
    private $menu;

    public function __construct(CatalogManagementInterface $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        $menus = $this->menu->get();
        return view('admin.menu.index', [
            'menus'      => $menus,
            'categories' => Menu::CATEGORIES
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
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

    // CUSTOM FUNCTION

    public function category($id)
    {
        if($id == 'all') {
            $menus = $this->menu->get();
        } else {
            $menus = $this->menu->getMenuByCategory($id);
        }
        return view('admin.menu.component.menu-item', [
            'menus'      => $menus,
            'categories' => Menu::CATEGORIES
        ])->render();
    }

    public function search(Request $request) {
        $menus = $this->menu->search($request->search);
        return view('admin.menu.component.menu-item', [
            'menus'      => $menus,
            'categories' => Menu::CATEGORIES
        ])->render();
    }
}
