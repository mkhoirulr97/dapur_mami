<?php

namespace App\Http\Controllers;

use App\Interfaces\CatalogManagementInterface;
use App\Models\DeliveryOrder;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $menu;
    private $catalogMenu;

    public function __construct(CatalogManagementInterface $menu, CatalogManagementInterface $catalogMenu)
    {
        $this->menu = $menu;
        $this->catalogMenu = $catalogMenu;
    }

    public function index()
    {
        return view('user.index', [
            'favoriteMenu'         => $this->favoriteMenu(),
            'whatsapp' => Setting::first()->phone,
        ]);
    }

    public function favoriteMenu()
    {
        // find favorite menu by count menus_id in transaction_details and sum quantity, make limit 5 menu
        $favoriteMenu = TransactionDetail::select('menus_id', DB::raw('sum(quantity) as total_quantity'))
            ->groupBy('menus_id')
            ->orderBy('total_quantity', 'desc')
            ->get();

        // get menu detail
        foreach ($favoriteMenu as $menu) {
            $menu->menu = Menu::find($menu->menus_id);
        }

        return $favoriteMenu;
    }

    public function menu()
    {
        return view('user.menu', [
            'products' => $this->menu->getWithTotalSales(),
            'setting' => Setting::first(),
            'invoice' => DeliveryOrder::generateInvoice(),
            'customer' => Auth::user()
        ]);
    }

    public function sortByPrice(Request $request)
    {
        $menus = $this->menu->sortByPrice($request->value);
        return view('user.component.list-menu', [
            'products' => $menus,
            'setting' => Setting::first(),
        ])->render();
    }

    public function sortByCategory(Request $request)
    {
        $menus = $this->menu->sortByCategory($request->value);
        return view('user.component.list-menu', [
            'products' => $menus,
            'setting' => Setting::first(),
        ])->render();
    }

    public function addCart($id)
    {
        $menu = $this->catalogMenu->find($id);
        return view('user.component.menu-item', [
            'menu' => $menu
        ])->render();
    }

    public function search(Request $request)
    {
        $menus = $this->menu->search($request->value);
        return view('user.component.list-menu', [
            'products' => $menus,
            'setting' => Setting::first(),
        ])->render();
    }
}
