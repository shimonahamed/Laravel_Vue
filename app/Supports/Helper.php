<?php


namespace App\Supports;


trait Helper
{
    public $model='';
    public function returnData($status=2000,$result=null,$message=null){

        $data=[];
        if ($status){
            $data['status']=$status;
        }
        if ($result){
            $data['result']=$result;
        }
        if ($message){
            $data['message']=$message;
        }
        return response()->json($data);

    }

}