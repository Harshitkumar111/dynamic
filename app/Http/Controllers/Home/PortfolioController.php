<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Image;
use Illuminate\Support\Carbon;

class PortfolioController extends Controller
{
    public function allPortfolio(){
      $protfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('protfolio'));
    }
    public function addPortfolio(){
       
          return view('admin.portfolio.portfolio_add');
      }
      public function storePortfolio(Request $request){
       $request->validate([
        'portfolio_name'=>'required',
        'portfolio_title'=>'required',
        'portfolio_image'=>'required',
       ],[
        'portfolio_name.required' =>'Portfolio Name is Required',
        'portfolio_title.required' =>'Portfolio Title is Required',
        'portfolio_image.required' =>'Portfolio Image is Required',

       ]);
       $image = $request->file('portfolio_image');
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
       $save_url = 'upload/portfolio/'.$name_gen;
       Portfolio::insert([
           'portfolio_name'=>$request->portfolio_name,
           'portfolio_title'=>$request->portfolio_title,
           'portfolio_image'=>$save_url,
           'portfolio_description'=>$request->portfolio_description,
           'created_at'=>Carbon::now(),
       ]);
       $notification = array(
           'message' => 'Portfolio Insert Successfully',
           'alert-type' => 'success'
       );
       return redirect()->route('all.portfolio')->with($notification);

    }
    public function editPortfolio($id){      
        $editprotfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit',compact('editprotfolio'));   
    }
    public function updatePortfolio(Request $request){      
        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_gen);
            $save_url = 'upload/portfolio/'.$name_gen;
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_title'=>$request->portfolio_title,
                'portfolio_name'=>$request->portfolio_name,
                'portfolio_image'=>$save_url,
                'portfolio_description'=>$request->portfolio_description,
            ]);
            $notification = array(
                'message' => 'Porftolio Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }else{
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_title'=>$request->portfolio_title,
                'portfolio_name'=>$request->portfolio_name,
                'portfolio_description'=>$request->portfolio_description,

            ]);
            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }  
    }
    public function deletePortfolio($id){
        
        $multi=Portfolio::findOrFail($id);
        
        $img=$multi->portfolio_image;
        
        unlink($img);
        Portfolio::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Portfolio Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
     public function detailsPortfolio($id){
        
        $details=Portfolio::findOrFail($id);
        return view('frontend.portfolio_details',compact('details'));

     }
     public function HomePortfolio(){

        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio',compact('portfolio'));
       }
}
