<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;

class TQuestionTable extends BllBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TQuestionTable ());
    }
    /**
     * 获得邮箱验证信息
     */
    public function GetModelByMail($f_mail,$f_validation)
    {
        return $this->dal->GetModelByMail($f_mail,$f_validation);
    }
}
