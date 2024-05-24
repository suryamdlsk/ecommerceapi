<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
     // Get all products
     public function index()
     {
         $products = Product::all();
         return response()->json($products);
     }

     // Create  new product
     public function store(Request $request){
        if($request->isMethod('post')){
            $productData=$request->all();
            // echo  "<pre>";print_r($productData);die;


            $rules=[
                'products.*.name' => 'required|string',
                'products.*.description' => 'nullable|string',
                'products.*.price' => 'required|numeric',
                'products.*.quantity' => 'required|integer',
                'products.*.is_active' => 'required|boolean'
            ];
            $customMessages = [
                'products.*.name.required' => 'The name field is required.',
                'products.*.description.string' => 'The description must be a string.',
                'products.*.price.required' => 'The price field is required.',
                'products.*.price.numeric' => 'The price must be a number.',
                'products.*.quantity.required' => 'The quantity field is required.',
                'products.*.quantity.integer' => 'The quantity must be an integer.',
                'products.*.is_active.required' => 'The is active field is required.',
                'products.*.is_active.boolean' => 'The is active field must be true or false.'
            ];



            $validator = Validator::make( $productData, $rules ,$customMessages);
            if ($validator->fails()) {
                return response()->json($validator->errors(),422);
            }


            foreach ($productData['products'] as $value){
                $product = new Product;
                $product->name=$value['name'];
                $product->description=$value['description'];
                $product->price=$value['price'];
                $product->quantity=$value['quantity'];
                $product->save();
            }

            return response()->json(["success_message"=>"Products added successfully"],201);
        }
     }

      // Get a specific product
      public function show($id)
      {
          $product = Product::findOrFail($id);
          return response()->json($product);
      }

      // Update a product
     public function update(Request $request, $id){
        if($request->isMethod('put')){
            $product = $request->all();
           // echo  "<pre>";print_r($product);die;

            $rules=[
               'name' => 'required|string',
               'description' => 'nullable|string',
               'price' => 'required|numeric',
               'quantity' => 'required|integer',
               'is_active' => 'required|boolean'
           ];
           $customMessages = [
               'name.required' => 'The name field is required.',
               'description.string' => 'The description must be a string.',
               'price.required' => 'The price field is required.',
               'price.numeric' => 'The price must be a number.',
               'quantity.required' => 'The quantity field is required.',
               'quantity.integer' => 'The quantity must be an integer.',
               'is_active.required' => 'The is active field is required.',
               'is_active.boolean' => 'The is active field must be true or false.'
           ];

           $validator = Validator::make( $product, $rules ,$customMessages);
           if ($validator->fails()) {
               return response()->json($validator->errors(),422);
           }

           Product::where('id',$id)->update([
               'name'=>$product['name'],
               'description'=>$product['description'],
               'price'=>$product['price'],
               'quantity'=>$product['quantity'],
               'is_active'=>$product['is_active']
           ]);

           return response()->json(["success_message"=>"Product update successfully"],200);
        }

     }

     // Delete a product
     public function destroy($id)
     {
         $product = Product::findOrFail($id);
         $product->delete();
        return response()->json(["success_message"=>"Product deleted successfully"],204);
     }
}
