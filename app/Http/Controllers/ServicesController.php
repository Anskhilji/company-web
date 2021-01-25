<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeServices;
use Illuminate\Support\Facades\Redirect;

class ServicesController extends Controller
{
    public function HomeService()
    {
        $services = HomeServices::all();
        return view('admin.services.index',compact('services'));
    }

    public function AddService()
    {
        return view('admin.services.create');
    }

    public function StoreService(Request $request)
    {
        $services = new HomeServices();
        $services->title = $request->title;
        $services->des = $request->des;
        $services->icon = $request->icon;

        $services->save();

        return Redirect()->route('home.services')->with('success','Services added successfully');
    }

    public function EditService($id)
    {
        $services = HomeServices::find($id);
        return view('admin.services.edit',compact('services'));
    }

    public function UpdateService(Request $request,$id)
    {
        $service = HomeServices::find($id);
        $service->title = $request->title;
        $service->des = $request->des;
        $service->icon = $request->icon;

        $service->save();

        return Redirect()->route('home.services')->with('success','Services updated successfully');
    }

    public function DeleteService($id)
    {
        $delete = HomeServices::find($id)->delete();
        return Redirect()->back()->with('success','Services Deleted successfully');

    }

}
