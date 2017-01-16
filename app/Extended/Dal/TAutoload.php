<?php namespace App\Extended\Dal;

use App\Extended\Dal\Base\DalBase;
use Illuminate\Support\Facades\DB;

class TAutoload extends DalBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct("\\App\\Extended\\Model\\TAutoload");
    }

    /**
     * 通过URL获取对象
     */
    public function GetModelByUrl($f_url, $f_floor)
    {
        $modelName = $this->modelName;
        return $modelName::where('f_url', '=', $f_url)->where('f_floor', '=', $f_floor)->first();
    }

    /**
     * 通过URL获取最后页数
     */
    public function GetMaxPage($f_url)
    {
        return  DB::select("select f_page from t_autoload where f_url='".$f_url."' order by f_create_time desc limit 1");
    }
}
