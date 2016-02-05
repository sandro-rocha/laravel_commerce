<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    private $products;
    public function __construct(Product $product)
    {
        $this->products = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->products->all();
        return view('admin.products', compact('products'));
    }
    public function show($id)
    {
        $products = $this->products->find($id);
        return view('admin.products', compact('products'));
    }   
}
