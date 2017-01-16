<?php namespace App\Extended\Dal;

use App\Extended\Common\StringHelper;
use App\Extended\Dal\Base\DalBase;
use Illuminate\Support\Facades\DB;

class TClient extends DalBase {
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TClient");
    }

    /**
     * 通过名称获取对象
     */
    public function GetModelByName($f_name)
    {
        $modelName = $this->modelName;
        return $modelName::where('f_name', '=', $f_name)->first();
    }
    /**
     * 模糊查询
     */
    public function Query($f_name)
    {
        $modelName = $this->modelName;
        if(StringHelper::IsEmpty($f_name)){
//            return $modelName::where('f_name', 'like', '%' . $f_name . '%')->orderBy('f_create_time', 'desc')->take(10)->get();
            return  DB::select("select a.*,(select count(0) from t_group as s1 where s1.f_client_id=a.f_id) as f_group_count from t_client as a order by f_create_time desc limit 10");
        }else {
//            return $modelName::where('f_name', 'like', '%' . $f_name . '%')->orderBy('f_create_time', 'desc')->get();
            return  DB::select("select a.*,(select count(0) from t_group as s1 where s1.f_client_id=a.f_id) as f_group_count from t_client as a where a.f_name like '%".$f_name."%' order by f_create_time desc");
        }
    }

    /**
     * 通过事件获取账号列表
     */
    public function GetModelsByEventId($f_event_id)
    {
        return  DB::select("select a.*,(select count(0) from t_group as s1 where s1.f_client_id=a.f_id) as f_group_count from t_client as a where a.f_id in(select f_client_id from t_group where f_event_id='".$f_event_id."') order by f_create_time desc");
    }
}
