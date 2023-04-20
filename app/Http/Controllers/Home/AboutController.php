<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Image;

class AboutController extends Controller
{
    public function aboutslider(){
        $about = About::find(1);
        return view('admin.about_page.about_page_all',compact('about'));
    }
    public function updateabout(Request $request){

        $about_id = $request->id;

        if($request->file('about_image')){
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/about_page_image/'.$name_gen);
            $save_url = 'upload/about_page_image/'.$name_gen;
            About::findOrFail($about_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
                'about_image'=>$save_url,
            ]);
            $notification = array(
                'message' => 'Home Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            About::findOrFail($about_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,

            ]);
            $notification = array(
                'message' => 'About Page Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function about(){
        $about = About::find(1);
        return view('frontend.about_page',compact('about'));
    }
    public function aboutMultiImage(){
        return view('admin.about_page.multiimage');
    }
    public function storemultiimage(Request $request){
      $image = $request->multi_image;
      foreach ($image as $multi_image) {
        $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
        Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_gen);
        $save_url = 'upload/multi/'.$name_gen;
        MultiImage::insert([
            'multi_image'=>$save_url,
            'created_at'=>Carbon::now(),
        ]);
        }
        $notification = array(
            'message' => 'Multi Image Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);
      
    }
    public function allmultiimage(){
        $allmultiimage=MultiImage::all();
        return view('admin.about_page.all_multiimage', compact('allmultiimage'));
     }
     public function editmultiimage($id){
        $editimage=MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('editimage'));
     }
     public function updatemultiimage(Request $request){

        $multi_image=$request->id;
        if($request->file('multi_image')){
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
            $save_url = 'upload/multi/'.$name_gen;
            MultiImage::findOrFail($multi_image)->update([
                'multi_image'=>$save_url,
            ]);       
            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.multi.image')->with($notification);
     }
    }
    public function deletemultiimage($id){
        
        $multi=MultiImage::findOrFail($id);
        
        $img=$multi->multi_image;
        //heloo mai harshit hu 
        unlink($img);
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
}
