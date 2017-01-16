<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;

class TDictionaries extends DalBase {
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TDictionaries");
    }
}
