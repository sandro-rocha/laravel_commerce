<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Requests\CartRequest;
use CodeCommerce\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        if (!Session::has('cart')) {
            $cart = Session::set('cart', $this->cart);
        }

        //dd(Session::get('cart'));
        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    public function add($id)
    {
        $cart = $this->getCart();

        $product = Product::find($id);

        $productImage = isset($product->images->first()->id) ? $product->images->first()->id : 'no-img';
        $productExtension = isset($product->images->first()->extension) ? $product->images->first()->extension : 'jpg';

        $cart->add($id, $product->name, $product->price, $productImage, $productExtension);
        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function destroy($id)
    {
        $cart = $this->getCart($id);
        $cart->remove($id);

        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    public function update(CartRequest $request, $id, Session $session)
    {
        $data = $request->all();

        $cart = $this->getCart($session);

        $product = Product::find($id);

        $cart->update($id, $product->name, $product->price, $data['qtd']);

        if ($data['qtd'] == 0) {
            $cart->remove($id);
        }

        $session::set('cart', $cart);

        return redirect()->route('cart');
    }


    /**
     * @return Cart
     */
    public function getCart()
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
        } else {
            $cart = $this->cart;
        }
        return $cart;
    }
}
