<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\GhranTrait;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class MediaController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $medias = Media::paginate(10);
        return view('admin.media.index',compact('medias'));
    }

    public function read($id)
    {
        $media = $this->checkModel(new Media,$id);
        $read=$media->update(['read'=>1]);
        return view('admin.media.show',compact('media'));
    }


    public function delete($id)
    {
        try{
            $media = $this->checkModel(new Media,$id);
            $media->delete();
            return redirect()->route('media.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
