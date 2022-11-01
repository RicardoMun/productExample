<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Database\Factories\ProductFactory;
use App\Http\Resources\api\v1\ProductResource;
use App\Http\Resources\api\v1\ProductCollection;
use App\Http\Requests\api\v1\ProductStoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('name', 'asc')->get();

        //return response()->json(['data' => $product], 200);

        //return ProductResource::collection($product); //Se hace una clección solo con el resource

        return (new ProductCollection($product))
            ->response()
            ->setStatusCode(200);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $user = $request->user();

        $product = new Product();
        $product->fill($request->all());
        $product->user_id = $user->id;
        $product->save();

        //$product = Product::create($request->all());

        return response()->json(['data' => $product], 201);
        //return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        //return response()->json(['data' => $product], 200);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json(['data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null, 204);
    }
}
