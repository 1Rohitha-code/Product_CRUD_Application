<?php

namespace App\Http\Controllers;

use App\ProductDetail;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //display product data list table
    public function show_list(){
        $data = DB::table('product_categories')
        ->get();
    //   dd($data);
        return view('admin.product_categories.product_list',compact('data'));
    }
     //display product variants data
     public function show_variant($id){
        return ProductDetail::find($id);
    }

    //display product data insertion form
    public function create_product(){
        $get_cat_data = DB::table('product_categories')->select('name','id')->get();
        return view('admin.product_data.data_insertion_form',compact('get_cat_data'));
    }

    //store product data
    public function store_form_data(Request $request){
        $validatedData = $request->validate([
             'title' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
             'class' => 'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
             'price' => 'required|numeric|min:1|max:10000.00',
             'image' => 'required|mimes:jpeg,jpg|max:2048',
             'available_stock' => 'required|numeric|min:1|max:500'
        ]);

        /* 
        if the selected value is milk, then product data is saved
        under Milk category.
        if the selected value is buiscuits, then product data is saved
        under Buiscuits category.
        */
        if($request->name == "Milk"){
                    $store_product_data = new ProductDetail();
                    $store_product_data->prod_cat_id = $request->input('prod_cat_id');
                    $store_product_data->title = $request->input('title');
                    $store_product_data->available_stock = $request->input('available_stock');
                    $store_product_data->class = $request->input('class');
                    $store_product_data->price = $request->input('price');
                    $store_product_data->image = $request->input('image');
                
                    if($request->hasfile('image')){
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalExtension();
                        $filename = time().'.'.$extension;
                        $file->move('uploads/product_imgs',$filename);
                        $store_product_data->image = $filename;
                    }else{
                        return $request;
                    }
            
                    $store_product_data->save();
        }
        else{
                    $store_product_data = new ProductDetail();
                    $store_product_data->prod_cat_id = $request->input('prod_cat_id');
                    $store_product_data->title = $request->input('title');
                    $store_product_data->available_stock = $request->input('available_stock');
                    $store_product_data->class = $request->input('class');
                    $store_product_data->price = $request->input('price');
                    $store_product_data->image = $request->input('image');
        
                if($request->hasfile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extension;
                    $file->move('uploads/product_imgs',$filename);
                    $store_product_data->image = $filename;
                }else{
                    return $request;
                }
            $store_product_data->save();
        }

        return redirect('/create_form')->with('status','Product data inserted successfully!');
        
    }//method paranthesis

    //display product data edit page
    public function editable_data($id){

        $get_editable_data =  DB::table('product_categories')
        ->join('product_details','product_categories.id','=','product_details.prod_cat_id')
        ->where('product_details.id','=',$id)
        ->get();
        return view('admin.product_data.product_edit_page',compact('get_editable_data'));

    }

    //update product data
    public function update_prod_data($id,Request $request){
       $update_data = DB::table('product_details')
       ->where('product_details.id','=',$id)
       ->update([
        'title'=> $request->title,
        'class'=>$request->class,
        'price'=>$request->price,
        'available_stock'=>$request->available_stock,  
       ]);

       $update_image = ProductDetail::find($id);
       if($request->hasfile('image')){
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('uploads/product_imgs',$filename);
        $update_image->image = $filename;
    }
    $update_image->save();

    $get_prod_cat_id = DB::table('product_details')
    ->select('product_details.prod_cat_id')
    ->where('product_details.id','=',$id)
    ->first()->prod_cat_id;
    return redirect('/single_prod_data/'.$get_prod_cat_id)->with('status','Product data updated successfully!');
  
    }

    //deleting product data
    public function delete_product($id){
    $delete_product_data = ProductDetail::find($id);
    $delete_product_data->delete(); 
    return redirect('/single_prod_data/'.$id)->with('status','Product data deleted successfully!');
    }


    //display category data insertion form
    public function display_cat_form(){
        return view('admin.product_categories.cat_data_insertion_form');
    }

    //save category data
    public function store_cat_form(Request $request){ 
       $save_cat = new ProductCategory();
       $save_cat->name = $request->input('name');
       $save_cat->status = $request->input('status');
       $save_cat->save();
       return redirect('/product_list')->with('status','One category inserted successfully!');
    }

    //display category edit form
    public function edit_cat_form($id){
        $get_prod_cat_data = ProductCategory::find($id);
        return view('admin.product_categories.edit_cat_page',compact(['id','get_prod_cat_data']));
    }

    //updates category data
    public function update_cat_form($prod_cat_id,Request $request){
        $update_cat_data = DB::table('product_categories')
        ->where('product_categories.id','=',$prod_cat_id)
        ->update([
         'name'=> $request->name,
         'status'=>$request->status,  
        ]);
        return redirect('/admin_dashboard')->with('status','Category data updated successfully!');
        
    }

    //deleting a category
    public function delete_cat_form($id){
        $delete_category_data = ProductCategory::find($id);
        $delete_category_data->delete(); 
        return redirect('/product_list/')->with('status','One category deleted successfully!');

    }

    //display product category list table
    public function show_prod_data($prod_cat_id){

        $prod_details = DB::table('product_categories')
        ->join('product_details','product_categories.id','=','product_details.prod_cat_id')
        ->where('prod_cat_id','=',$prod_cat_id)
        ->get();
      // dd($prod_details );
       return view('admin.product_data.single_product_page',compact('prod_details'));
    }

   

    
}
