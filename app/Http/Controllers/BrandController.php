<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
       return view('admin.brand.index',compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name'=> 'required|unique:brands|min:4',
            'brand_image'=> 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required'=> 'Please input Brand name',
                'brand_name.min'=> 'Brand longer than 4 Characters',
            ]
        );

        $brand_image = $request->file('brand_image');

//        $name_gen = hexdec(uniqid());
//        $img_ext = strtolower($brand_image->getClientOriginalExtension());
//        $img_name = $name_gen.'.'.$img_ext;
//        $up_location = 'image/brand/';
//
//        $last_img = $up_location.$img_name;
//        $brand_image->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;
        Brand::insert([
           'brand_name'=> $request->brand_name,
            'brand_image'=> $last_img,
            'created_at' => \Illuminate\Support\Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand inserted successfully');

    }

    public function Edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'brand_name'=> 'required|min:4',
        ],
            [
                'brand_name.required'=> 'Please input Brand name',
                'brand_name.min'=> 'Brand longer than 4 Characters',
            ]
        );

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image){
//           $name_gen = hexdec(uniqid());
//           $img_ext = strtolower($brand_image->getClientOriginalExtension());
//           $img_name = $name_gen.'.'.$img_ext;
//           $up_location = 'image/brand/';
//
//           $last_img = $up_location.$img_name;
//           $brand_image->move($up_location,$img_name);
            $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

            $last_img = 'image/brand/'.$name_gen;
            unlink($old_image);

           Brand::find($id)->update([
               'brand_name'=> $request->brand_name,
               'brand_image'=> $last_img,
               'created_at' => \Illuminate\Support\Carbon::now()
           ]);

           return Redirect()->back()->with('success', 'Brand inserted successfully');
       }else{
            Brand::find($id)->update([
                'brand_name'=> $request->brand_name,
                'created_at' => \Illuminate\Support\Carbon::now()
            ]);

            return Redirect()->back()->with('success', 'Brand inserted successfully');
        }

    }

    public function Delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Deleted successfully');

    }

//    that is for multiImage all method
    public function MultiPic()
    {
        $images = MultiPic::paginate(6);
        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImg(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required',
            'image.*'=> 'mimes:jpg,jpeg,png'
        ]);

        $image = $request->file('image');

        foreach ($image as $multiPic){
            $name_gen = hexdec(uniqid()).'.'.$multiPic->getClientOriginalExtension();
            Image::make($multiPic)->resize(300,300)->save('image/multi/'.$name_gen);

            $last_img = 'image/multi/'.$name_gen;
            MultiPic::insert([
                'image'=> $last_img,
                'created_at' => \Illuminate\Support\Carbon::now()
            ]);
        } // End foreach

        return Redirect()->back()->with('success', 'Multiple images inserted successfully');
    }

}
