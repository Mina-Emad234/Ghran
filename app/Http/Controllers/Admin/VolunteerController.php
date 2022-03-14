<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Traits\GhranTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PHPUnit\Exception;

class VolunteerController extends Controller
{
    use GhranTrait;
    public function index()
    {
        $teams = Team::paginate(10);
        return view('admin.volunteer.index',compact('teams'));
    }

    public function read($id)
    {
        $team =$this->checkModel(new Team,$id);
        $read=$team->update(['read'=>1]);
        return view('admin.volunteer.show',compact('team'));
    }


    public function delete($id)
    {
        try{
            $team =$this->checkModel(new Team,$id);
            $team->delete();
            return redirect()->route('volunteer.index')->with(['success_msg' => "تم حذف الرسالة بنجاح"]);
        }catch (Exception $ex){
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);
        }
    }
}
