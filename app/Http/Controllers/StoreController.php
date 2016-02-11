<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use CodeCommerce\Product;
use CodeCommerce\Tag;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $category;
    private $product;

    function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
        $pFeatured = Product::featured()->get();
        $pRecommend = Product::recommend()->get();

        $categories = Category::all();

        return view('store.index', compact('categories','pFeatured','pRecommend'));
    }

    public function productCategory($id)
    {
        $pCategory = Product::ProductCategory($id)->get();
        $category = $this->category->find($id);
        
        $categories = Category::all();

        return view('store.products_category', compact('categories','category','pCategory'));
    }
}