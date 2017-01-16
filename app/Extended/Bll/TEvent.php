<?php


namespace App\Extended\Bll;

require 'phpQuery.php';
require 'QueryList.php';

use App\Extended\Bll\Base\BllBase;
use QL\QueryList;
use App\Extended\Dal\Base\DalBase;
use App\Extended\Model\Base\ModelBase;
use App\Extended\Common\GUIDHelper;
use App\Extended\Common\StringHelper;
use App\Extended\Common\Exception\CheckDataException;
use Exception;
use Illuminate\Http\Request;

class TEvent extends BllBase
{
    private $bllTLog;
    private $bllTClient;
    private $bllTGroup;
    private $bllTUrl;
    private $bllTAutoload;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TEvent());
        $this->bllTLog = new \App\Extended\Bll\TLog();
        $this->bllTClient = new \App\Extended\Bll\TClient();
        $this->bllTGroup = new \App\Extended\Bll\TGroup();
        $this->bllTUrl = new \App\Extended\Bll\TUrl();
        $this->bllTAutoload = new \App\Extended\Bll\TAutoload();
    }

    public function Add(ModelBase $model)
    {
        $this->Check($model); // 检验数据
        return parent::Add($model);
    }

    public function Update(ModelBase $model)
    {
        $this->Check($model); // 检验数据
        return parent::Update($model);
    }

    /**
     * 新增事件
     */
    public function NewEvent($f_event_title, $f_event_remark, $f_client_name, $f_clients, $f_url, $f_urls, $f_ip)
    {
        try {
            if (StringHelper::IsEmpty($f_client_name) && is_array($f_clients) == false) {
                throw new CheckDataException ('请录入账号');
            }
            //事务开始
            DalBase::TransactionBegin();
            //添加事件
            $event = new \App\Extended\Model\TEvent();
            $event->f_id = GUIDHelper::CreateGUID();
            $event->f_title = $f_event_title;
            $event->f_remark = $f_event_remark;
            $event->f_ip = $f_ip;
            $event->f_comment_count = 0;
            //添加账号
            if (StringHelper::IsEmpty($f_client_name) == false && (is_array($f_clients) == false || in_array($f_client_name, $f_clients, true) == false)) {
                $client = $this->bllTClient->GetModelByName($f_client_name);
                if ($client == null) {
                    $client = new \App\Extended\Model\TClient();
                    $client->f_id = GUIDHelper::CreateGUID();
                    $client->f_name = $f_client_name;
                    $client->f_type = 0;//默认，无类型
                    $client->f_name_type = 0;//默认，无类型
                    //关系
                    $group = new \App\Extended\Model\TGroup();
                    $group->f_id = GUIDHelper::CreateGUID();
                    $group->f_client_id = $client->f_id;
                    $group->f_event_id = $event->f_id;
                    $this->bllTClient->Add($client);
                    $this->bllTGroup->Add($group);
                } else {
                    $group = new \App\Extended\Model\TGroup();
                    $group->f_id = GUIDHelper::CreateGUID();
                    $group->f_client_id = $client->f_id;
                    $group->f_event_id = $event->f_id;
                    $this->bllTGroup->Add($group);
                }
            }
            if (is_array($f_clients)) {
                foreach ($f_clients as $c) {
                    $client = $this->bllTClient->GetModelByName($c);
                    if ($client == null) {
                        $client = new \App\Extended\Model\TClient();
                        $client->f_id = GUIDHelper::CreateGUID();
                        $client->f_name = $c;
                        $client->f_type = 0;//默认，无类型
                        $client->f_name_type = 0;//默认，无类型
                        //关系
                        $group = new \App\Extended\Model\TGroup();
                        $group->f_id = GUIDHelper::CreateGUID();
                        $group->f_client_id = $client->f_id;
                        $group->f_event_id = $event->f_id;
                        $this->bllTClient->Add($client);
                        $this->bllTGroup->Add($group);
                    } else {
                        $group = new \App\Extended\Model\TGroup();
                        $group->f_id = GUIDHelper::CreateGUID();
                        $group->f_client_id = $client->f_id;
                        $group->f_event_id = $event->f_id;
                        $this->bllTGroup->Add($group);
                    }
                }
            }
            //添加地址
            if (StringHelper::IsEmpty($f_url) == false && (is_array($f_urls) == false || in_array($f_url, $f_urls, true) == false)) {
                $url = new \App\Extended\Model\TUrl();
                $url->f_id = GUIDHelper::CreateGUID();
                $url->f_title = $f_url;
                $url->f_url = $f_url;
                $url->f_event_id = $event->f_id;
                $url->f_type = 0;//默认，无类型
                $this->bllTUrl->Add($url);
            }
            if (is_array($f_urls)) {
                foreach ($f_urls as $u) {
                    $url = new \App\Extended\Model\TUrl();
                    $url->f_id = GUIDHelper::CreateGUID();
                    $url->f_title = $u;
                    $url->f_url = $u;
                    $url->f_event_id = $event->f_id;
                    $url->f_type = 0;//默认，无类型
                    $this->bllTUrl->Add($url);
                }
            }
            $this->Add($event);
            //事务提交
            DalBase::TransactionCommit();
        } catch (Exception $e) {
            //事务回滚
            DalBase::TransactionRollBack();
            $this->bllTLog->LogException($e);//记录日志
            throw $e;
        }
    }

    /**
     * 检验数据
     * @param ModelBase $model
     * @throws CheckDataException
     */
    public function Check(ModelBase $model)
    {
        if (StringHelper::IsEmpty($model->f_id))
            throw new CheckDataException ('id不能为空');

        if (StringHelper::IsEmpty($model->f_title))
            throw new CheckDataException ('请输入事件标题');

        if (StringHelper::CheckStrLen($model->f_title, 4, 50) == false)
            throw new CheckDataException ('事件标题长度必须多于4-50位');

        if (StringHelper::IsEmpty($model->f_remark))
            throw new CheckDataException ('请输入事件内容');

        if (StringHelper::CheckStrLen($model->f_remark, 10, 500) == false)
            throw new CheckDataException ('事件内容长度必须为6-15位');
    }

    public function GetModelsByClientId($f_client_id)
    {
        return $this->dal->GetModelsByClientId($f_client_id);
    }

    /**
     * 自动读取贴吧事件信息
     */
    public function AutoEvent(Request $request)
    {
        $url = 'http://tieba.baidu.com/p/4448568199';
        $page = $this->bllTAutoload->GetMaxPage($url);
        if ($page == null || count($page) == 0 || $page[0]->f_page == 0) {
            $page = 1;
        } else {
            $page = $page[0]->f_page;
            if ($page > 1) {
                $page = $page - 1;
            }
        }
        $this->AutoEventPage($url, $page);
        return 'success';
    }

    /**
     * 自动读取贴吧事件信息(分页读取)
     */
    public function AutoEventPage($url, $page)
    {
        try {
            //事务开始
            DalBase::TransactionBegin();
            $cookie_jar = tempnam("", "cookie");//存储cookie的文件，第一个参数可以设置为c:\windows\temp、c:\windows\system32之类文件夹
            /*$request = 'user=abcd9.com&pw=abcd9.com';

//提交的参数，如帐号、密码等，在实际应用时填写可参考抓包数据中的参数及对应值

            $ch = curl_init();

            curl_setopt($ch,CURLOPT_URL,'http://www.abcd9.com/admin/index.php?action=login');

//提交的目标地址

            curl_setopt($ch, CURLOPT_POST, 1);

//设置提交方式为POST

            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);

//设置POST提交内容

            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);

//把返回来的cookie信息保存在$cookie_jar文件中

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//设定返回的数据是否自动显示

            curl_setopt($ch, CURLOPT_HEADER, false);

//设定是否显示头信息

            curl_setopt($ch, CURLOPT_NOBODY, false);

//设定是否输出页面内容

            curl_exec($ch);

            curl_close($ch);*/
            //添加读取记录
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, $url . '?pn=' . $page);//抓取的后台页面地址
            curl_setopt($ch2, CURLOPT_HEADER, false);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_jar);
            $content = curl_exec($ch2);
            curl_close($ch2);
            unlink($cookie_jar);//释放cookie临时文件
            //var_dump($content);
            //采集规则
            $rules = array(
                'pageSize' => array('.l_posts_num .l_reply_num span:eq(1)', 'text'),
            );
            $hj = QueryList::Query($content, $rules);
            $pageSum = $hj->data[0]['pageSize'];//总页数
            $rules2 = array(
                'name' => array('.d_author .d_name', 'text'),
                'floor' => array('.post-tail-wrap .tail-info:contains(\'楼\')', 'text'),
                'content' => array('.d_post_content', 'text'),
            );
            $hj = QueryList::Query($content, $rules2, '.left_section .l_post');
            $items = $hj->data;//名称，楼数，内容
            for ($i = 0; $i < count($items); $i++) {
                if (preg_match("/{{相关账号：(.+)描述标题：(.+)描述内容：(.+)相关位置：(.+)}}/i", $items[$i]['content'], $matches)) {
                    $floor = StringHelper::Replace($items[$i]['floor'], '楼', '');
                    if ($this->bllTAutoload->GetModelByUrl($url, $floor) == null) {
                        //添加事件信息
                        $f_clients = StringHelper::Split($matches[1], '|');
                        $f_event_title = $matches[2];
                        $f_event_remark = $matches[3];
                        $f_urls = StringHelper::Split($matches[4], '|');
                        $this->NewEvent($f_event_title, $f_event_remark, null, $f_clients, null, $f_urls, 'AutoEvent');
                        //添加楼层信息
                        $autoload = new \App\Extended\Model\TAutoload();
                        $autoload->f_id = GUIDHelper::CreateGUID();
                        $autoload->f_url = $url;
                        $autoload->f_floor = $floor;
                        $autoload->f_page = $page;
                        $this->bllTAutoload->Add($autoload);
                    }
                }
            }

            //事务提交
            DalBase::TransactionCommit();
            if ($page < $pageSum) {
                $this->AutoEventPage($url, $page + 1);//读取下一页
            }
        } catch (Exception $e) {
            //事务回滚
            DalBase::TransactionRollBack();
            $this->bllTLog->LogException($e);//记录日志
            throw $e;
        }
    }
}
