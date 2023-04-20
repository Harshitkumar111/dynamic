<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;


class FooterController extends Controller
{
    public function footersetup(){
        $footer = Footer::find(1);
          return view('admin.footer.footer_all',compact('footer'));
      }
      public function UpdateFooter(Request $request){
        $request->validate([
            'number'=>'required',
            'short_description'=>'required',
            'adress'=>'required',
            'email'=>'required',
            'facebook'=>'required',
            'twitter'=>'required',
            'copyright'=>'required',
           ],[
            'number.required' =>'Phone Number Category is Required',
            'short_description.required' =>'Description is Required',
            'adress.required' =>'Adress is Required',
            'email.required' =>'Email is Required',
            'facebook.required' =>'Facebook is Required',
            'twitter.required' =>'Twitter is Required',
            'copyright.required' =>'Copyright is Required',
           ]);
        $footer_id = $request->id;

         Footer::findOrFail($footer_id)->update([
                'number' => $request->number,
                'short_description' => $request->short_description,
                'adress' => $request->adress,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,

            ]); 
            $notification = array(
            'message' => 'Footer Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } 
}
