<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use DB;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function __construct()
    {
            //user not login so redirect to the login page except login logout
           $this->middleware('auth:admin');
    }
    //display brans list 
    public function brand(){
        $brand = Brand::all();
         return view('admin.category.brand',compact('brand'));
    }
    //insert store brands with logo into the database 
    public function storebrand(Request $request){
        $validateData = $request->validate([
       'brand_name' => 'required|unique:brands|max:55',
   
        ]);
   
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $image = $request->file('brand_logo');
        if ($image) {
          $image_name = date('dmy_H_s_i');
          $ext = strtolower($image->getClientOriginalExtension());
          $image_full_name = $image_name.'.'.$ext;
          $upload_path = 'media/brand/';
          $image_url = $upload_path.$image_full_name;
          $success = $image->move($upload_path,$image_full_name);
   
          $data['brand_logo'] = $image_url;
          $brand = DB::table('brands')->insert($data);
           $notification=array(
               'messege'=>'Brand Inserted Successfully',
               'alert-type'=>'success'
                );
              return Redirect()->back()->with($notification);
        }else{
             $brand = DB::table('brands')->insert($data);
             $notification=array(
               'messege'=>'Its Done',
               'alert-type'=>'success'
                );
              return Redirect()->back()->with($notification);
        }
   
    }
    //Delete a Brand also delete a image from the media brand folder
    public function DeleteBrand($id){
        $data = DB::table('brands')->where('id',$id)->first();
        $image = $data->brand_logo;
        unlink($image);//delete image from the folder
        $brand = DB::table('brands')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Brand Deleted Successfully',
                 'alert-type'=>'success'
                  );
                return Redirect()->back()->with($notification); 
       }

    //edit brand logo on click open edit page
    public function EditBrand($id){
        $brand = DB::table('brands')->where('id',$id)->first();
        return view('admin.category.edit_brand',compact('brand'));
  
    }   

    //update brand with logo 
    public function UpdateBrand(Request $request, $id){

        $oldlogo = $request->old_logo;
       $data = array();
            $data['brand_name'] = $request->brand_name;
            $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $image = $request->file('brand_logo');
            if ($image) {
             unlink($oldlogo);
              $image_name = date('dmy_H_s_i');
              $ext = strtolower($image->getClientOriginalExtension());
              $image_full_name = $image_name.'.'.$ext;
              $upload_path = 'media/brand/';
              $image_url = $upload_path.$image_full_name;
              $success = $image->move($upload_path,$image_full_name);
       
              $data['brand_logo'] = $image_url;
              $brand = DB::table('brands')->where('id',$id)->update($data);
               $notification=array(
                   'messege'=>'Brand Updated Successfully',
                   'alert-type'=>'success'
                    );
                  return Redirect()->route('brands')->with($notification);
            }else{
                 $brand = DB::table('brands')->where('id',$id)->update($data);
                 $notification=array(
                   'messege'=>'Update Without Images',
                   'alert-type'=>'success'
                    );
                  return Redirect()->route('brands')->with($notification);
            }
       
         }

}
