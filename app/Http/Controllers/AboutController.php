<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use Illuminate\Http\Request;
use App\Models\MultiPic;
class AboutController extends Controller
{
    public function HomeAbout()
    {
        $home_about = HomeAbout::latest()->get();
        return view('admin.home.index',compact('home_about'));
    }

    public function AddAbout()
    {
        return view('admin.home.create');
    }

    public function StoreAbout(Request $request)
    {
        $validatedData = $request->validate([
           'title'=>'required',
           'short_dis'=>'required',
           'long_dis'=>'required',
        ]);

        $about = new HomeAbout();
        $about->title = $request->title;
        $about->short_dis = $request->short_dis;
        $about->long_dis = $request->long_dis;
        $about->save();

        return redirect()->route('home.about')->with('success','About data inserted Successfully');
    }

    public function EditAbout($id)
    {
        $homeAbout = HomeAbout::find($id);
        return view('admin.home.edit',compact('homeAbout'));
    }

    public function UpdateAbout(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title'=>'required',
            'short_dis'=>'required',
            'long_dis'=>'required',
        ]);

        $about = HomeAbout::find($id);

        $about->title = $request->title;
        $about->short_dis = $request->short_dis;
        $about->long_dis = $request->long_dis;
        $about->save();

        return redirect()->route('home.about')->with('success','About updated Successfully');
    }

    public function DeleteAbout($id)
    {
        $delete = HomeAbout::find($id)->delete();
        return redirect()->back()->with('success','About Deleted Successfully');

    }

    public function Portfolio()
    {
        $images = MultiPic::all();
        return view('pages.portfolio',compact('images'));
    }
}
