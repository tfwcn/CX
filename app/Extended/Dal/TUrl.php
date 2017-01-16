<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;

class TUrl extends DalBase {
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TUrl");
    }

    /**
     * 通过URL获取对象
     */
    public function GetModelsByUrl($f_url)
    {
        $modelName = $this->modelName;
        return $modelName::where('f_url', '=', $f_url)->orderBy('f_create_time')->get();
    }
    public function GetModelsByEventId($f_event_id)
    {
        $modelName = $this->modelName;
        return $modelName::where('f_event_id', '=', $f_event_id)->orderBy('f_create_time')->get();
    }
}
