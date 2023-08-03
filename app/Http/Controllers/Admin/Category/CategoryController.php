<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
class CategoryController extends Controller
{
    //
    public function __construct()
    {
            //user not login so redirect to the login page except login logout
           $this->middleware('auth:admin');
    }
    public function category(){
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }

    // insert or store category date into the database 
    public function storecategory(Request $request){
    
        $validateData = $request->validate([
       'category_name' => 'required|unique:categories|max:255',
        ]);
    
      //$data=array();
      //$data['category_name']=$request->category_name;
      //DB::table('categories')->insert($data);
    
    
     $category = new Category();
     $category->category_name =$request->category_name;
     $category->created_at = \Carbon\Carbon::now()->toDateTimeString();
     $category->updated_at = \Carbon\Carbon::now()->toDateTimeString();
     $category->save();
      $notification=array(
                'messege'=>'Category Added Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
     
      }

    // delete category by cat id 
    public function Deletecategory($id){
        DB::table('categories')->where('id',$id)->delete();
         $notification=array(
              'messege'=>'Category Deleted Successfully',
              'alert-type'=>'success'
               );
             return Redirect()->back()->with($notification);
    }  

    //edit category 
    public function Editcategory($id){ 
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
       }
      
    // update category  
    public function Updatecategory(Request $request, $id){
         $validateData = $request->validate([
         'category_name' => 'required|max:255',
          ]);
      
         $data=array();
         $data['category_name']=$request->category_name;
         $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
         $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
         $update=DB::table('categories')->where('id',$id)->update($data);
         if ($update) {
              $notification=array(
                  'messege'=>'Category Updated Successfully',
                  'alert-type'=>'success'
                   );
                 return Redirect()->route('categories')->with($notification);
         }else{
             $notification=array(
                  'messege'=>'Nothing To Update',
                  'alert-type'=>'error'
                   );
                 return Redirect()->route('categories')->with($notification);
         }
      
      
          }
}
