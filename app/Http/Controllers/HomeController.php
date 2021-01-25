<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;
use Auth;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function HomeSlider()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Please input Brand name',
                'brand_name.min' => 'Brand longer than 4 Characters',
            ]
        );

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);

        $last_img = 'image/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider inserted successfully');
    }

    public function EditSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function UpdateSlider(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $old_image = $request->old_image;
        $slider_image = $request->file('image');

        if ($slider_image) {

            $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);

            $last_img = 'image/slider/'.$name_gen;
            unlink($old_image);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->route('home.slider')->with('success', 'Slider updated successfully');

        } else {
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('home.slider')->with('success', 'Slider updated successfully');
        }
    }

    public function DeleteSlider($id)
    {
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider delete successfully');
    }
}
