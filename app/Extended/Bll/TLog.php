<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;
use App\Extended\Common\GUIDHelper;
use Exception;

class TLog extends BllBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TLog());
    }

    /**
     * 添加日志
     * @param $f_type
     * @param $f_msg
     */
    public function AddMsg($f_type, $f_msg)
    {
        $log = new \App\Extended\Model\TLog();
        $log->f_id = GUIDHelper::CreateGUID();
        $log->f_type = $f_type;
        $log->f_msg = $f_msg;
        $this->Add($log);
    }

    /**
     * 异常日志
     * @param $e
     */
    public function LogException(Exception $e)
    {
        try {
            $log = new \App\Extended\Model\TLog();
            $log->f_id = GUIDHelper::CreateGUID();
            $log->f_type = 'Exception';
            $log->f_msg = $e->getTraceAsString();
            $this->Add($log);
        } catch (Exception $ex) {
            //忽略异常
        }
    }
}
