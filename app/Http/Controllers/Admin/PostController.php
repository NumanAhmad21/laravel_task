<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{
    //
    public function __construct()
    {
            //user not login so redirect to the login page except login logout
           $this->middleware('auth:admin');
    }
    //display post category blog list
    public function BlogCatList(){
        $blogcat = DB::table('post_category')->get();
        return view('admin.blog.category.index',compact('blogcat'));
      
        }
        //insert/store blog category into the post category table
        public function BlogCatStore(Request $request){
            $validateDate = $request->validate([
            'category_name_en' => 'required|max:255',
            'category_name_in' => 'required|max:255',
          
            ]);
          
            $data = array();
            $data['category_name_en'] = $request->category_name_en;
            $data['category_name_ar'] = $request->category_name_in;
            $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
            $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
            DB::table('post_category')->insert($data);
            $notification=array(
                      'messege'=>'Blog Category Added Successfully',
                      'alert-type'=>'success'
                       );
                     return Redirect()->back()->with($notification); 
            }

            //delete blog category 
            public function DeleteBlogCat($id){
                DB::table('post_category')->where('id',$id)->delete();
                $notification=array(
                       'messege'=>'Blog Category Deleted Successfully',
                       'alert-type'=>'success'
                        );
                      return Redirect()->back()->with($notification);
           
            }
            //edit blog category 
            public function EditBlogCat($id){
                $blogcatedit = DB::table('post_category')->where('id',$id)->first();
                return view('admin.blog.category.edit',compact('blogcatedit'));
         
            }
            //update blog category
            public function UpdateBlogCat(Request $request,$id){
                $data = array();
                $data['category_name_en'] = $request->category_name_en;
                $data['category_name_ar'] = $request->category_name_in;
                DB::table('post_category')->where('id',$id)->update($data);
                $notification=array(
                          'messege'=>'Blog Category Update Successfully',
                          'alert-type'=>'success'
                           );
                         return Redirect()->route('add.blog.categorylist')->with($notification); 
               
               }
               //show add post form
               public function Create(){

                $blogcategory = DB::table('post_category')->get();
                return view('admin.blog.create',compact('blogcategory'));
             
               }
               //insert / store post into the posts 
               public function store(Request $request){

                $data = array();
                $data['post_title_en'] = $request->post_title_en;
                $data['post_title_ar'] = $request->post_title_ar;
                $data['category_id'] = $request->category_id;
                $data['details_en'] = $request->details_en;
                $data['details_ar'] = $request->details_ar;
                $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                $post_image = $request->file('post_image');
              
                if ($post_image) {
                   $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
                   Image::make($post_image)->resize(400,200)->save('media/post/'.$post_image_name);
                   $data['post_image'] = 'media/post/'.$post_image_name;
              
                   DB::table('posts')->insert($data);
                   $notification=array(
                          'messege'=>'Post Inserted Successfully',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);
              
                }else{
                    $data['post_image']='';
                    DB::table('posts')->insert($data);
                   $notification=array(
                          'messege'=>'Post Inserted Without Image',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);
               
                     }
                }
                //display posts list table
                public function index(){
                    $post = DB::table('posts')
                            ->join('post_category','posts.category_id','post_category.id')
                            ->select('posts.*','post_category.category_name_en')
                            ->get();
                           return view('admin.blog.index',compact('post'));
                           // return response()->json($post);
                
                 }
                 //delete post
                 public function DeletePost($id){
                    $post = DB::table('posts')->where('id',$id)->first();
                    $image = $post->post_image;
                    unlink($image);
                  
                    DB::table('posts')->where('id',$id)->delete();
                     $notification=array(
                              'messege'=>'Post Deleted Successfully',
                              'alert-type'=>'success'
                               );
                             return Redirect()->back()->with($notification);
                   
                    }
                    //edit post 
                    public function EditPost($id){
                        $post = DB::table('posts')->where('id',$id)->first();
                        return view('admin.blog.edit',compact('post'));
                  
                    }
                    //update post
                    public function UpdatePost(Request $request,$id){

                        $oldimage = $request->old_image;
                      
                      $data = array();
                        $data['post_title_en'] = $request->post_title_en;
                        $data['post_title_ar'] = $request->post_title_ar;
                        $data['category_id'] = $request->category_id;
                        $data['details_en'] = $request->details_en;
                        $data['details_ar'] = $request->details_ar;
                        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
                        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
                        $post_image = $request->file('post_image');
                      
                        if ($post_image) {
                            unlink($oldimage);
                           $post_image_name = hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
                           Image::make($post_image)->resize(400,200)->save('media/post/'.$post_image_name);
                           $data['post_image'] = 'media/post/'.$post_image_name;
                      
                           DB::table('posts')->where('id',$id)->update($data);
                           $notification=array(
                                  'messege'=>'Post Updated Successfully',
                                  'alert-type'=>'success'
                                   );
                                 return Redirect()->route('all.blogpost')->with($notification);
                      
                        }else{
                            $data['post_image']= $oldimage;
                             DB::table('posts')->where('id',$id)->update($data);
                           $notification=array(
                                  'messege'=>'Post Updated Without Image',
                                  'alert-type'=>'success'
                                   );
                                  return Redirect()->route('all.blogpost')->with($notification);
                       
                             } 
                       }

}
