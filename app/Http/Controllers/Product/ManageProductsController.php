<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Actions\CreateProduct;
use App\Actions\UpdateProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ManageProductsController extends Controller
{

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, CreateProduct $createProduct)
    {
        //
        $request->validated();
        $createProduct($request->all());

        return back()->with('success', 'Product stored successfully');
    }


    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProduct $updateProduct)
    {
        //
        $request->validated();
        $updateProduct($request->except('_token', '_method'), $product);

        return back()->with('success', 'This product has been updated!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();

        return redirect(route('products.index'))->with('success', 'Product deleted!');
    }
}
