<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;
use Illuminate\Support\Facades\DB;

class TEvent extends DalBase {
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TEvent");
    }

    /**
     * 通过账号获取事件列表
     */
    public function GetModelsByClientId($f_client_id)
    {
        return  DB::select("select a.*,(select count(0) from t_group as s1 where s1.f_event_id=a.f_id) as f_group_count,(select count(0) from t_url as s1 where s1.f_event_id=a.f_id) as f_url_count from t_event as a where a.f_id in(select f_event_id from t_group where f_client_id='".$f_client_id."') order by a.f_create_time desc");
    }
}
