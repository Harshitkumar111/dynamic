<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homeslide;
use Image;
class HomesliderController extends Controller
{
    public function homeslider(){
        $homesilde = Homeslide::find(1);
        return view('admin.home_silde_all',compact('homesilde'));
    }
    public function updateslider(Request $request){
        $slider_id = $request->id;

        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/home_slider/'.$name_gen);
            $save_url = 'upload/home_slider/'.$name_gen;
            Homeslide::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'home_slide'=>$save_url,
                'video_url'=>$request->video_url,
            ]);
            $notification = array(
                'message' => 'Home Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            Homeslide::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'video_url'=>$request->video_url,

            ]);
            $notification = array(
                'message' => 'Home Slider Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    
    public function homeMain(){
       
        return view('frontend.index');
    }

}
