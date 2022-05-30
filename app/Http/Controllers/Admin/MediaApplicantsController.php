<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\GhranTrait;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class MediaApplicantsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $medias = Media::paginate(10);
        return view('admin.media.index',compact('medias'));
    }

    public function read(Media $applicant)
    {
        $read=$applicant->update(['read'=>1]);
        return view('admin.media.show',compact('applicant'));
    }


    public function delete(Media $applicant)
    {
        try{
            $applicant->delete();
            return redirect()->route('media.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
