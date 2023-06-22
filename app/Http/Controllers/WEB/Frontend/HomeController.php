<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;

class HomeController extends Controller
{
    public function index()
    {   
        $slider = Slider::select(['id', 'title_one', 'title_two', 'image'])->skip(1)->first();


        $feateuredCategories = featuredCategories();

        return view('frontend.home.index', compact('slider', 'feateuredCategories'));
    }

    public function subCategoriesByCategory(Request $request)
    {
        if($request->type == 'subcategory')
        {
            $id = Category::whereSlug($request->slug)->first()->id;
            $categories = SubCategory::where(['category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }  
            
            return view('frontend.category.sub-category', compact('categories'));
        }        
        else if($request->type == 'childcategory')
        {
            $id = SubCategory::whereSlug($request->slug)->first()->id;
            $categories = ChildCategory::where(['sub_category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }   

            return view('frontend.category.child-category', compact('categories'));
        }

    }

    public function shop(Request $request)
    {
        $data = [];

        if(empty($data))
        {
            $data = Category::with('products')->whereSlug($request->slug)->first();
        }  

        if(empty($data))
        {
            $data = SubCategory::with('products')->whereSlug($request->slug)->first();
        }        
        
        if(empty($data))
        {
            $data = ChildCategory::with('products')->whereSlug($request->slug)->first();
        }

        if(empty($request->slug))
        {
            $products = Product::with(['category', 'subCategory', 'childCategory'])->take(30)->get();
        }

        else if($data){
            $products = $data->products;
        }
        
        else{
            $products = [];
        }
        

        return view('frontend.shop.index', compact('products'));
    }

}
