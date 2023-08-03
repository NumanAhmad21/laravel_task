<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    //inser newslater in newslater table 
    public function StoreNewslater(Request $request){
    	$validateData = $request->validate([
     'email' => 'required|unique:newslater|max:55',
    	]);

        $data = array();
        $data['email'] = $request->email;

        $data['created_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $data['updated_at'] = \Carbon\Carbon::now()->toDateTimeString();
        DB::table('newslater')->insert($data);
        $notification=array(
                    'messege'=>'Thanks for Subscribing',
                    'alert-type'=>'success'
                    );
                return Redirect()->back()->with($notification); 	

    }
}
