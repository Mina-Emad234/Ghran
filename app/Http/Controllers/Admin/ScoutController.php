<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scout;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ScoutController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $scouts = Scout::paginate(10);
        return view('admin.scouts.index',compact('scouts'));
    }

    public function read($id)
    {
        $scout = Scout::find($id);
        if(!$scout)
            return redirect()->back()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        $read=$scout->update(['read'=>1]);
        return view('admin.scouts.show',compact('scout'));
    }


    public function delete($id)
    {
        try{
            $scout = $this->checkModel(new Scout,$id);
            $this->deleteWithImage('uploads/scouts/'.$scout->image,$scout);
            return redirect()->route('scouts.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
