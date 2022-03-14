<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\site\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;

class ContactController extends Controller
{
    public function getPage()
    {
        return view('site.contact.send');
    }
    public function send(ContactRequest $request)
    {
        try {
            if ($request->has('file')) {
                $image = $request->file('file');
                $file_name = $image->getClientOriginalName();
                $contact_email = $request->email;
                $imageName = $request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/contacts/' . $contact_email), $imageName);
            }else{
                $file_name=Null;
            }
            Contact::create([
                'sender'=>$request->sender,
                'email'=>$request->email,
                'title'=>$request->title,
                'content'=>$request->content,
                'file'=>$file_name
            ]);
            $data=['sender'=>$request->sender];
                Mail::to($request->email)->send(new ContactMail($data));
            setcookie('contact_sent', $request->email, time()+(60*60*24*2),'/');
            return redirect()->route('contact.page')->with(['contact_success'=>'تم التسجيل بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->withInput()->with(['contact_error'=>'حدث خطأ ما حاول مرة أخرى']);
        }
    }

}
