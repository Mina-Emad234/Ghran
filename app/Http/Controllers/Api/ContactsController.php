<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($contacts as $contact){
            unset($contacts[$i]);
            $contacts->push(array_merge($contact->toArray(),['link'=>url('/api/contacts_api/'.$contact->id)]));
            $i++;
        }
        return $contacts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try{
            if ($request->has('file')) {
                $image = $request->file('file');
                $file_name = $image->getClientOriginalName();
                $contact_email = $request->email;
                $imageName = $request->file->getClientOriginalName();
                $request->file->move(public_path('uploads/contacts/' . $contact_email), $imageName);
            }else{
                $file_name=Null;
            }
            $contact=Contact::create([
                'sender'=>$request->sender,
                'email'=>$request->email,
                'title'=>$request->title,
                'content'=>$request->content,
                'file'=>$file_name
            ]);
            return response($contact);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        try{
            Storage::disk('public_uploads')->delete($contact->email.'/'.$contact->file);
            Storage::disk('public_uploads')->deleteDirectory($contact->email);
            $contact->delete();
            return response(['message'=>'تم حذف بيانات الأتصال بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
