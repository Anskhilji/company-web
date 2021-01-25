<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
class ChangePasswordController extends Controller
{
    public function ChangePassword()
    {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validatedData = $request->validate([
           'oldpassword'=>'required',
           'password'=>'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','User password change successfully');
        }else{
            return redirect()->back()->with('error','Invalid oldpassword!');
        }
    }

//    User profile

    public function ProfileUpdate()
    {
        if (Auth::user()){
            $user = User::find(Auth::id());
            if ($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }

    public function UserProfileUpdate(Request $request)
    {
        $validateData = $request->validate([
           'name'=>'required',
           'email'=>'required|email',
        ]);
        $oldImage = $request->oldImage;
        $profileImage = $request->file('image');

        if ($profileImage){
            $user = User::find(Auth::id());
            if ($user){
                $name_gen = hexdec(uniqid()).'.'.$profileImage->getClientOriginalExtension();
                Image::make($profileImage)->resize(300,200)->save('image/profile/'.$name_gen);

                $last_img = 'image/profile/'.$name_gen;
                if (file_exists($oldImage)){
                    unlink($oldImage);
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->profile_photo_path = $last_img;
                $user->save();
                return redirect()->back()->with('success','Profile update with image successfully');
            }else {
                return redirect()->back();
            }

        }else {
            $user = User::find(Auth::id());
            if ($user){
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();
                return redirect()->back()->with('success','Profile update successfully');
            }
        }


    }

}

//$validatedData = $request->validate([
//    'brand_name'=> 'required|min:4',
//],
//    [
//        'brand_name.required'=> 'Please input Brand name',
//        'brand_name.min'=> 'Brand longer than 4 Characters',
//    ]
//);
//
//$old_image = $request->old_image;
//$brand_image = $request->file('brand_image');
//
//if ($brand_image){
//
//    $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
//    Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
//
//    $last_img = 'image/brand/'.$name_gen;
//    unlink($old_image);
//
//    Brand::find($id)->update([
//        'brand_name'=> $request->brand_name,
//        'brand_image'=> $last_img,
//        'created_at' => \Illuminate\Support\Carbon::now()
//    ]);
//
//    return Redirect()->back()->with('success', 'Brand inserted successfully');
//}else{
//    Brand::find($id)->update([
//        'brand_name'=> $request->brand_name,
//        'created_at' => \Illuminate\Support\Carbon::now()
//    ]);
//
//    return Redirect()->back()->with('success', 'Brand inserted successfully');
//}

