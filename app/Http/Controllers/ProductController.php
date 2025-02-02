<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Response;
class ProductController extends Controller
{
    public function index(){
      $products=Product::all();
      return view('Products.index',['products'=>$products]);
    } 
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
   $data= $request->validate([
    'name'=>'required',
    'category'=>'required',
    'price'=>'required|numeric',
    'Descriptions'=>'nullable'
   ]);
   $newP=Product::create($data);
   return redirect(route('product.index'));
    }
    public function edit(product $Product){
return view ('products.edit',['Product'=>$Product]);
    }

    public function update(Product $Product,Request $request){
        $data= $request->validate([
            'name'=>'required',
            'category'=>'required',
            'price'=>'required|numeric',
            'Descriptions'=>'nullable'
           ]);
           $Product->update($data);
           return redirect(route('product.index'));

            }
    public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('product.index'); // Redirect to the product list after deletion
}

}
