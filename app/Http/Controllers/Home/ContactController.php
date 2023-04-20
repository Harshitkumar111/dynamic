<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    //

    public function contact(){
          return view('frontend.contact');
      }
      public function storemessage(Request $request){
        $request->validate([

            'name'=>'required',
            'phone'=>'required',
            'message'=>'required',
            'email'=>'required',
        
        ],[
            'name.required' =>'Name is Required',
            'message.required' =>'Message is Required',
            'email.required' =>'Email is Required',
            'phone.required' =>'Phone is Required',
        
        ]);
        Contact::insert([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'message'=>$request->message,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'created_at'=>Carbon::now('Asia/Kolkata'),
        ]);
        $notification = array(
            'message' => 'Your Message Submited Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function ContactMessage(){

        $contacts = Contact::latest()->get();
        return view('admin.contact.allcontact',compact('contacts'));

    }
    public function deletemessage($id){
        
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Your Message Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     }
}
