<?php

namespace CodeCommerce\Http\Controllers;
;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        // $this->middleware('auth'); - verifica se o usuario esta logado
        $this->productModel = $productModel;
    }

    public function index()
    {
        $products = $this->productModel->orderBy('id', 'DESC')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');

        return view('products.create', compact('categories'));
    }

    public function store(Requests\ProductRequest $request)
    {
        $product = $this->productModel->fill($request->all());
        $product->save();

        $inputTags = array_map('trim', explode(',', $request->get('tags')));
        $this->storeTag($inputTags,$product->id);

        return redirect()->route('products')->with('product_store', 'Product create!');
    }

    public function edit($id, Category $category)
    {
        $categories = $category->lists('name', 'id');

        $product = $this->productModel->find($id);
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $this->productModel->findOrNew($id)->update($request->all());

        $input = array_map('trim', explode(',', $request->get('tags')));
        $this->storeTag($input,$id);

        return redirect()->route('products')->with('product_update', 'Product updated!');
    }

    public function destroy($id)
    {
        $product = $this->productModel->find($id);

        if($product)
        {
            if($product->images)
            {
                foreach($product->images as $image){
                    if(file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension))
                    {
                        Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
                    }
                    $image->delete();
                }
            }
            $product->delete();
            return redirect()->route('products')->with('product_destroy', 'Product deleted!');
        }
        return redirect()->route('products')->with('product_exist', 'Product not exist!');
    }

    private function storeTag($inputTags, $id)
    {
        $tag = new Tag();

        foreach ($inputTags as $key => $value) {
            $newTag = $tag->firstOrCreate(["name" => $value]);
            $idTags[] = $newTag->id;
        }
        $product = $this->productModel->find($id);
        $product->tags()->sync($idTags);

    }

    public function images($id)
    {
        $product = $this->productModel->find($id);
        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->productModel->find($id);
        return view('products.create_image', compact('product'));
    }

    public function storeImage(Requests\ProductImageRequest $requests, $id, ProductImage $productImage)
    {
        $file = $requests->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('products.images',['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);

        if(file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension))
        {
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images', ['id'=>$product->id]);
    }
}
