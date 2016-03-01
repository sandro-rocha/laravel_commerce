<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth_admin');
    }
    public function place(Order $orderModel, OrderItem $orderItem)
    {
        if (!Session::has('cart')) {
            return false;
        }
        $cart = Session::get('cart');
        $categories = Category::all();
        if (count(Auth::user()->address) <= 0) {
            return redirect()->route('account_address')->with('address_exist', 'Você precisa ter um endereço de entrega antes de finalizar compra!');
        }
        if ($cart->getTotal() > 0) {
            $order = $orderModel->create(['user_id' => Auth::user()->id, 'total' => $cart->getTotal()]);
            foreach ($cart->all() as $k => $item) {
                $order->items()->create([
                    'product_id' => $k,
                    'price' => $item['price'],
                    'qtd' => $item['qtd']
                ]);
            }
            $cart->clear();
            event(new CheckoutEvent(Auth::user(), $order));
            return view('store.checkout', compact('order', 'categories'));
        }
        return view('store.checkout', ['cart' => 'empty', 'categories' => $categories]);
    }
}