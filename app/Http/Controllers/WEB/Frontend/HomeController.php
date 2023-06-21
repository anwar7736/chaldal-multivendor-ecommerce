<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;

class HomeController extends Controller
{
    public function index()
    {   
        $slider = Slider::select(['id', 'title_one', 'title_two', 'image'])->skip(1)->first();

        $categories = Category::select(['id', 'name', 'slug', 'image'])->take(9)->get();

        return view('frontend.home.index', compact('slider', 'categories'));
    }

    public function subCategoriesByCategory(Request $request)
    {
        if($request->type == 'category')
        {
            $id = Category::whereSlug($request->slug)->first()->id;
            $categories = SubCategory::where(['category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }  
            
            return view('frontend.category.sub-category', compact('categories'));
        }        
        else if($request->type == 'subcategory')
        {
            $id = SubCategory::whereSlug($request->slug)->first()->id;
            $categories = ChildCategory::where(['sub_category_id' => $id])->get();
            if($categories->count() <= 0)
            {
                return redirect()->route('front.shop', ['slug'=> $request->slug ] );
            }   

            return view('frontend.category.sub-category2', compact('categories'));
        }

    }

    public function shop(Request $request)
    {
        $data = [];
        if(empty($data))
        {
            $data = Category::whereSlug($request->slug)->first();
        }  

        if(empty($data))
        {
            $data = SubCategory::whereSlug($request->slug)->first();
        }        
        
        if(empty($data))
        {
            $data = ChildCategory::whereSlug($request->slug)->first();
        }

        $products = $data->products;

        return view('frontend.shop.index', compact('products'));
    }

}
