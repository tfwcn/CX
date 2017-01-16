<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;

class TQuestionTable extends DalBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TQuestionTable");
    }

    /**
     * 获得邮箱验证信息
     */
    public function GetModelByMail($f_mail, $f_validation)
    {
        $modelName = $this->modelName;
        if ($f_validation == null) {
            return $modelName::where('f_mail','=',$f_mail)->first();
        } else {
            return $modelName::where('f_mail','=',$f_mail)->where('f_validation','=',$f_validation)->first();
        }
    }
}
