<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class ContactsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $contacts = Contact::orderByDesc('id')->paginate(10);
        return view('admin.contact.index',compact('contacts'));
    }

    public function read(Contact $contact)
    {
        $read=$contact->update(['read'=>1]);
        return view('admin.contact.show',compact('contact'));
    }

    public function open_file($email,$file)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($email.'/'.$file);
        return response()->file($files);
    }

    public function delete(Contact $contact)
    {
        try {
            Storage::disk('public_uploads')->delete($contact->email.'/'.$contact->file);
            Storage::disk('public_uploads')->deleteDirectory($contact->email);
            $contact->delete();
                return redirect()->route('contact.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }

}
