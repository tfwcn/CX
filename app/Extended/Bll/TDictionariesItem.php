<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;

class TDictionariesItem extends BllBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TDictionariesItem ());
    }
}
