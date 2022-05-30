<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scout;
use App\Traits\GhranTrait;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class ScoutsController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $scouts = Scout::paginate(10);
        return view('admin.scouts.index',compact('scouts'));
    }

    public function read(Scout $scout)
    {
        $read=$scout->update(['read'=>1]);
        return view('admin.scouts.show',compact('scout'));
    }


    public function delete(Scout $scout)
    {
        try{
            $this->deleteWithImage('uploads/scouts/'.$scout->image,$scout);
            return redirect()->route('scouts.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
