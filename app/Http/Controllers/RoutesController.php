<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoutesController extends Controller
{

    /**
     * 路由跳转,post方法后面加"_Post"
     *
     * @return Response
     */
    public function Route(Request $request, $action)
    {
        if (substr($action, -5) == "_Post") // 禁止访问Post方法
            return "";
        if ($request->method() == "POST" && method_exists($this, $action . "_Post")) {
            $action .= "_Post";
        }
        return $this->$action ($request);
    }
}
