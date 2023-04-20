<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
class BlogCategoryController extends Controller
{
    public function allblogcategory(){
        $blogcategory = BlogCategory::latest()->get();
          return view('admin.blog_category.blog_category_all',compact('blogcategory'));
      }
      public function addblogcategory(){
          return view('admin.blog_category.blog_category_add');
      }
      public function storeblogcategory(Request $request){
        $request->validate([
         'blog_category'=>'required',
    
        ],[
         'blog_category.required' =>'Blog Category name is Required',
 
        ]);

        BlogCategory::insert([
            'blog_category'=>$request->blog_category,
    
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.blog.category')->with($notification);
 
     }
     public function editblogcategory($id){      
        $editblogcategory = BlogCategory::find($id);
        return view('admin.blog_category.blog_category_edit',compact('editblogcategory'));
    }
    public function updateblogcategory(Request $request){ 
        // $request->validate([
        //     'blog_category'=>'required',
       
        //    ],[
        //     'blog_category.required' =>'Blog Category name is Required',
    
        //    ]);     
        $editblogcategory_id = $request->id;

            BlogCategory::findOrFail($editblogcategory_id)->update([
                'blog_category'=>$request->blog_category,
             
            ]);
            $notification = array(
                'message' => 'Blog Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.category')->with($notification);
     
    }
    public function deleteblogcategory($id){
    
        
       
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Category Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
}
