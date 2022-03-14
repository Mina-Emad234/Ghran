<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListMail;
use App\Traits\GhranTrait;
use GuzzleHttp\ClientTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ListMailController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $mails = ListMail::paginate(5);
        return view('admin.list_mail.index',compact('mails'));
    }
    public function delete($id){
        try{
            $mail = $this->checkModel(new ListMail,$id);
            $mail->delete();
            return redirect()->route('list_mail.index')->with(['success_msg'=>'تم حذف البريد الالكتروني بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
