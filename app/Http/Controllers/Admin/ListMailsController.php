<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListMail;
use App\Traits\GhranTrait;
use GuzzleHttp\ClientTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ListMailsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $mails = ListMail::paginate(10);
        return view('admin.list-mails.index',compact('mails'));
    }
    public function delete(ListMail $mail){
        try{
            $mail->delete();
            return redirect()->route('mails.index')->with(['success_msg'=>'تم حذف البريد الالكتروني بنجاح']);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
