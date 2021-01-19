<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat(){
//          $categories = DB::table('categories')
//              ->join('users','categories.user_id','=','users.id')
//              ->select('categories.*','users.name')
//              ->latest()->paginate(6);
        $categories = Category::latest()->paginate(5);

        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
//        $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name'=> 'required|unique:categories|max:255',
        ],
            [
                'category_name.required'=> 'Please input category name',
                'category_name.unique'=> 'Category already exist',
                'category_name.max'=> 'Category less than 255Chars',
            ]
        );
// Elequent ORM
        Category::insert([
           'category_name'=>$request->category_name,
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now()
        ]);
//        $category = new Category();
//        $category->category_name = $request->category_name;
//        $category->user_id = Auth::user()->id;
//        $category->save();

//        Query Builder
//        $data = array();
//        $data['category_name'] = $request->category_name;
//        $data['user_id'] = Auth::user()->id;
//        DB::table('categories')->insert($data);

        return redirect()->back()->with('success','Category inserted successfully!');

    }

    public function Edit($id)
    {
//        $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit',compact('categories'));
    }

    public function Update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name'=> 'required|unique:categories|max:255',
        ]);

//        $update = Category::find($id)->update([
//            'category_name'=>$request->category_name,
//            'user_id'=> Auth::user()->id
//        ]);

//   Query builder update
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);
        return redirect()->route('all.category')->with('success','Category Updated successfully!');
    }

    public function SoftDelete($id)
    {
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category Soft Deleted Successfully!');
    }

    public function Restore($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category restore successfully!');
    }

    public function PDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category permanently delete successfully!');
    }
}
