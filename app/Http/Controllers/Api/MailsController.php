<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MailRequest;
use App\Models\ListMail;
use Illuminate\Http\Request;

class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = ListMail::orderByDesc('id')->paginate(10);
        $i=0;
        foreach ($mails as $mail){
            unset($mails[$i]);
            $mails->push(array_merge($mail->toArray(),['link'=>url('/api/mails/'.$mail->id)]));
            $i++;
        }
        return $mails;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $request)
    {
        try{
            $mail=ListMail::create([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
            return response($mail);
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ListMail $mail)
    {
        return response($mail);
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
    public function destroy(ListMail $mail)
    {
        try{
            $mail->delete();
            return response(['message'=>'تم حذف البريد الإلكتروني بنجاح']);
        }catch (\Exception $ex){
            return response(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى'],400);
        }
    }
}
