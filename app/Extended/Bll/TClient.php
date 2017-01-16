<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;
use App\Extended\Model\Base\ModelBase;
use App\Extended\Common\Exception\CheckDataException;
use App\Extended\Common\StringHelper;

class TClient extends BllBase
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TClient ());
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

    public function GetModelByName($f_name)
    {
        return $this->dal->GetModelByName($f_name);
    }

    public function Query($f_name)
    {
        return $this->dal->Query($f_name);
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

        if (StringHelper::IsEmpty($model->f_name))
            throw new CheckDataException ('请输入账号');
    }
    public function GetModelsByEventId($f_event_id)
    {
        return $this->dal->GetModelsByEventId($f_event_id);
    }
}
