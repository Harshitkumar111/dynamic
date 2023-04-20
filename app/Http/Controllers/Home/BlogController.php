<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Image;
use Illuminate\Support\Carbon;


class BlogController extends Controller
{
    public function allblog(){
        $blogs = Blog::latest()->get();
          return view('admin.blogs.blogs_all',compact('blogs'));
      }
      public function addblog(){
        $blogcategory = BlogCategory::orderBy('blog_category','ASC')->get();
        return view('admin.Blogs.blogs_add',compact('blogcategory'));
    }
    public function storeblog(Request $request){
        $request->validate([
         'blog_category_id'=>'required',
         'blog_title'=>'required',
         'blog_tags'=>'required',
         'blog_description'=>'required',
         'blog_image'=>'required',

        ],[
         'blog_category_id.required' =>'Blog Category is Required',
         'blog_title.required' =>'Blog Title is Required',
         'blog_tags.required' =>'Blog Tages is Required',
         'blog_description.required' =>'Blog Description is Required',
         'blog_image.required' =>'Blog Image is Required',

        ]);

            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/Blog_image/'.$name_gen);
            $save_url = 'upload/Blog_image/'.$name_gen;
            Blog::insert([
                'blog_category_id'=>$request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_image'=>$save_url,
                'blog_tags'=>$request->blog_tags,
                'blog_description'=>$request->blog_description,
                'created_at'=>Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Create With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
     }

     public function editblog($id){      
        $editblog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('admin.blogs.blogs_edit',compact('editblog','categories')); 
    }
    public function updateblog(Request $request){      
       
        $request->validate([
            'blog_category_id'=>'required',
            'blog_title'=>'required',
            'blog_tags'=>'required',
            'blog_description'=>'required',
   
           ],[
            'blog_category_id.required' =>'Blog Category is Required',
            'blog_title.required' =>'Blog Title is Required',
            'blog_tags.required' =>'Blog Tages is Required',
            'blog_description.required' =>'Blog Description is Required',
   
           ]);
           $blog_id = $request->id;
        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/Blog_image/'.$name_gen);
            $save_url = 'upload/Blog_image/'.$name_gen;
            Blog::findOrFail($blog_id)->update([
                'blog_category_id'=>$request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_image'=>$save_url,
                'blog_tags'=>$request->blog_tags,
                'blog_description'=>$request->blog_description,
                'created_at'=>Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }else{
            Blog::findOrFail($blog_id)->update([
                'blog_category_id'=>$request->blog_category_id,
                'blog_title'=>$request->blog_title,
                'blog_tags'=>$request->blog_tags,
                'blog_description'=>$request->blog_description,
                'created_at'=>Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }  
    }
    public function deleteblog($id){
        
        $multi=Blog::findOrFail($id);
        
        $img=$multi->blog_image;
        
        unlink($img);
        Blog::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Blog Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
     public function blogdetails($id){
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        $allblog = Blog::latest()->limit(5)->get();
        $blog = Blog::findOrFail($id);
        return view('frontend.blogs_details',compact('blog','allblog','categories'));
     }

     public function categoryblog($id){
        $allblog = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $blog = Blog::where('blog_category_id',$id)->orderby('id','DESC')->get();
        $categoryname = BlogCategory::findOrFail($id);
        return view('frontend.category_blog_details',compact('blog','categories','allblog','categoryname'));
     }
     public function homeblog(){

        $categories = BlogCategory::orderBy('blog_category','ASC')->get();
        $allblogs = Blog::latest()->paginate(2);
        return view('frontend.blog',compact('allblogs','categories'));

     }
}
