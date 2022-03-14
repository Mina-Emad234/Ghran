<?php


namespace App\Traits;


use PhpParser\Node\Scalar\String_;

trait GhranTrait
{
    public function upload($file,$folder){
        $file_extension= $file->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $file->move($folder,$file_name);
        return $file_name;
    }

    public function checkModel($model,$id){
        $model_data = $model->find($id);
        if (!$model_data)
            return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

        return $model_data;
    }

    public function updateUpload($request,$file,$folder,$oldImage,$model){
        if ($request->has($file) && file_exists($folder.'/'.$oldImage)){
            unlink( $folder.'/'.$oldImage);
            $photo = $request->$file;
            $file_extension = $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $photo->move($folder, $file_name);
            $model->update([
                'image'=>$file_name
            ]);
        }
    }

    public function checkActive($request){
        if($request->has('active')){
            return $active=true;
        }else{
            return $active=false;
        }
    }

    public function modelActivation($model,$id,$value,string $msg,$route){

        try {
            $model_data = $model->find($id);
            if (!$model_data)
                return redirect()->back()->with(['error_msg' => 'هناك مشكلة ما من فضلك حاول مرة أخرى']);

            $model_data->update(['active'=>$value]);
            return redirect()->route($route)->with(['success_msg' => $msg]);
        }catch (\Exception $ex) {
            return redirect()->back()->withInput()->with(['error_msg' => "حدث خطأ ما من فضلك حاول مرة أخرى"]);
        }
    }

    public function deleteWithImage($path,$model){
        if(file_exists($path)){
            unlink($path);
        }
        $model->delete();
    }

    public function sortData($model,$route,$direction = 'up', $id = ''){
        switch ($direction) {
            case 'up':
                $this->sortProcess($model,$direction, $id);
                break;
            case 'down':
                $this->sortProcess($model,$direction, $id);
                break;
            default:
                break;
        }
        return redirect()->route($route);
    }

    public function sortProcess($model,$direction, $id)
    {
        $page = $model->where('id',$id)->first();
        if ($direction == 'up') {
            $order = $model->where("order", '<', $page->order)->orderBy('order','desc')->first();
        } else {
            $order =  $model->where("order", '>', $page->order)->orderBy('order','asc')->first();
        }
        if ($order) {
            $page->where('id',$id)->update(['order'=>$order->order]);
            $order->where('id',$order->id)->update(['order'=>$page->order]);
            return TRUE;
        }
    }
}
