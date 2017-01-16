<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;

class TQuestion extends DalBase {
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TQuestion");
    }

    /**
     * 获得随机问题
     */
    public function GetModelRand()
    {
        $modelName = $this->modelName;
        $count=$modelName::count();
        $count= rand(0, $count-1);
        return $modelName::limit(1)->offset($count)->first();
    }
}
