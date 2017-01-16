<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;

class LogController extends RoutesController
{
    private $bllTLog;

    /**
     * 初始化
     *
     * @return void
     */
    public function __construct()
    {
        $this->bllTLog = new \App\Extended\Bll\TLog();
    }
    /**
     * 记录错误
     *
     * @return Response
     */
    public function Error_Post(Request $request)
    {
        $retmsg = "";
        try {
            $this->bllTLog->AddMsg($request->input("f_type"), $request->input("f_msg"));
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }
}
