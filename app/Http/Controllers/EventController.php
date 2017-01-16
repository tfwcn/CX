<?php namespace App\Http\Controllers;

use App\Extended\Common\Exception\CheckDataException;
use App\Http\Requests;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends RoutesController
{
    private $bllTEvent;
    private $bllTClient;
    private $bllTUrl;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->bllTEvent = new \App\Extended\Bll\TEvent();
        $this->bllTClient = new \App\Extended\Bll\TClient();
        $this->bllTUrl = new \App\Extended\Bll\TUrl();
    }

    /**
     * 查询
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function Query(Request $request)
    {
        $f_name = $request->input('qv');
        $listClient = $this->bllTClient->Query($f_name);//查询
        return view('Event.Query', ['isLogin' => Session::has('LoginUser'), 'f_name' => $f_name, 'listClient' => $listClient]);
    }

    /**
     * 新增
     */
    public function NewEvent(Request $request)
    {
        $f_name = $request->input('id');
        return view('Event.NewEvent', ['isLogin' => Session::has('LoginUser'), 'f_name' => $f_name]);
    }

    /**
     * 新增事件
     *
     * @param Request $request
     * @return Response
     */
    public function NewEventSubmit_Post(Request $request)
    {
        $retmsg = "";
        try {
            $f_event_title = $request->input('f_event_title');
            $f_event_remark = $request->input('f_event_remark');
            $f_client_name = $request->input('f_client_name');
            $f_clients = $request->input('f_clients');
            $f_url = $request->input('f_url');
            $f_urls = $request->input('f_urls');
            $this->bllTEvent->NewEvent($f_event_title, $f_event_remark, $f_client_name, $f_clients, $f_url, $f_urls, $request->ip());//新增事件
        } catch (CheckDataException $e) {
            //验证提示
            $retmsg = $e->getMessage();
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }

    /**
     * 显示账号信息
     */
    public function ShowClient(Request $request)
    {
        try {
            $f_id = $request->input('id');
            $tmpClient = $this->bllTClient->GetModel($f_id);
            $tmpListEvent = $this->bllTEvent->GetModelsByClientId($f_id);
            return view('Event.ShowClient', ['isLogin' => Session::has('LoginUser'), 'tmpClient' => $tmpClient, 'tmpListEvent' => $tmpListEvent]);
        } catch (Exception $e) {
//            $retmsg = "异常：" . $e->getMessage();
        }
    }

    /**
     * 显示事件信息
     */
    public function ShowEvent(Request $request)
    {
        try {
            $f_id = $request->input('id');
            $tmpEvent = $this->bllTEvent->GetModel($f_id);
            $tmpListClient = $this->bllTClient->GetModelsByEventId($f_id);
            $tmpListUrl = $this->bllTUrl->GetModelsByEventId($f_id);
            return view('Event.ShowEvent', ['isLogin' => Session::has('LoginUser'), 'tmpEvent' => $tmpEvent, 'tmpListClient' => $tmpListClient, 'tmpListUrl' => $tmpListUrl]);
        } catch (Exception $e) {
//            $retmsg = "异常：" . $e->getMessage();
        }
    }

    /**
     * 自动读取贴吧事件信息
     */
    public function AutoEvent(Request $request)
    {
        $retmsg = '';
        try {
            $retmsg = $this->bllTEvent->AutoEvent($request);
        } catch (Exception $e) {
            $retmsg = "异常：" . $e->getMessage();
        }
        return $retmsg;
    }
}
