<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PartnersRequest;
use App\Models\Partner;
use App\Traits\GhranTrait;
use Exception;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    use GhranTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderByDesc('order')->paginate(10);
        $i=0;
        foreach ($partners as $partner){
            unset($partners[$i]);
            $partners->push(array_merge($partner->toArray(),['link'=>url('/api/partners/'.$partner->id)]));
            $i++;
        }
        return $partners;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnersRequest $request)
    {
        try{
            $file_name=$this->upload($request->image,'uploads/partners');
            $partner = Partner::create([
                'name'=>$request->name,
                'image'=>$file_name,
                'active'=>$request->active,
                'order'=>Partner::max('order') + 1
            ]);
            return response($partner);
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
    public function show(Partner $partner)
    {
        return response($partner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnersRequest $request, Partner $partner)
    {
        try{
            if($request->has('id') && $request->id == $partner->id) {
                $data = $request->except('image');
                $this->updateUpload($request, "image", 'uploads/partners', $partner->image, $partner);

                $partner->update($data);

                return response($partner);
            }
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        try{
            $this->deleteWithImage('uploads/partners/'.$partner->image,$partner);
            return response(['message'=>'تم حذف بيانات شريك بنجاح']);
        }catch (Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
