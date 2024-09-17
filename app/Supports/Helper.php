<?php


namespace App\Supports;


use Illuminate\Support\Facades\DB;

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
    public function can($permissionName)
    {
        $permissions = $this->authPermissions();
        if (in_array($permissionName, $permissions)){
            return true;
        };
        return false;
    }

    public function authPermissions()
    {
        return DB::table('permissions')
            ->join('role_permissions', 'permissions.id', '=', 'role_permissions.permission_id')
            ->where('role_id', auth()->user()->role_id)
            ->get()->pluck('name')->toArray();
    }

}