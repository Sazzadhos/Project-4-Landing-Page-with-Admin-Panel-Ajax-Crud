<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('id','asc')->get();
        return view('backend.pages.product.manageproduct', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.product.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $all)
    {

        $all->validate([
            'name'=>'required',
            'category_name'=>'required',
            'brand_name'=>'required',
            'description'=>'required',
            // 'image'=>'required',
        ]);

        $product = new Product();
        $product-> name = $all->name;
        $product-> category_name = $all->category_name;
        $product-> brand_name = $all->brand_name;
        $product-> description = $all->description;
        $product-> status = $all->status;

        if($all->image){
            $image = $all->File('image');
            $imageCustomName = rand().'.'.$image->getClientOriginalExtension();;
            $imagePath = public_path('backend/productimage/'.$imageCustomName);
            Image::make($image)->save($imagePath);
            $product->image = $imageCustomName;
        }
        $product-> save();
        return redirect()->route('manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.pages.product.editproduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product-> name = $request->name;
        $product-> category_name = $request->category_name;
        $product-> brand_name = $request->brand_name;
        $product-> description = $request->description;
        $product-> status = $request->status;

        if($request->image){
            if(File::exists('backend/productimage/'. $product->image)){
                File::delete('backend/productimage/'. $product->image);}

                $image = $request->File('image');
                $imageCustomName = rand().'.'.$image->getClientOriginalExtension();;
                $imagePath = public_path('backend/productimage/'.$imageCustomName);
                Image::make($image)->save($imagePath);
                $product->image = $imageCustomName;
        }
        $product-> update();
        return redirect()->route('manage');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(File::exists('backend/productimage/'. $product->image)){
            File::delete('backend/productimage/'. $product->image);}
        $product->delete();
        return redirect()->route('manage');
    }
}
