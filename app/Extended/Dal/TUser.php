<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;

class TUser extends DalBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TUser");
    }

    /**
     * 通过账号获取用户信息
     */
    public function GetModelByLoginName($f_login_name)
    {
        $modelName = $this->modelName;
        return $modelName::where('f_login_name', '=', $f_login_name)->first();
    }
}
