<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;
use App\Extended\Common\StringHelper;
use App\Extended\Common\Exception\CheckDataException;
use App\Extended\Model\Base\ModelBase;

class TUrl extends BllBase
{
//    private $bllTLog;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TUrl ());
//        $this->bllTLog = new \App\Extended\Bll\TLog();
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

    public function GetModelsByUrl($f_url)
    {
        return $this->dal->GetModelsByUrl($f_url);
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
            throw new CheckDataException ('标题不能为空');

        if (StringHelper::IsEmpty($model->f_url))
            throw new CheckDataException ('地址不能为空');

        if (StringHelper::IsEmpty($model->f_event_id))
            throw new CheckDataException ('eid不能为空');
    }
    public function GetModelsByEventId($f_event_id)
    {
        return $this->dal->GetModelsByEventId($f_event_id);
    }
}
