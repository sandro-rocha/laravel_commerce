<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Category;

class AdminCategoriesController extends Controller
{
    private $categories;
    public function __construct(Category $category)
    {
        $this->categories = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categories->all();
        return view('admin.categories', compact('categories'));
    }
    public function show($id)
    {
        $categories = $this->categories->find($id);
        return view('admin.categories', compact('categories'));
    }
}