<?php


namespace App\Extended\Bll;

use App\Extended\Bll\Base\BllBase;
use App\Extended\Common\StringHelper;
use App\Extended\Common\Exception\CheckDataException;
use App\Extended\Model\Base\ModelBase;

class TGroup extends BllBase
{
//    private $bllTLog;

    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct(new \App\Extended\Dal\TGroup ());
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

    /**
     * 检验数据
     * @param ModelBase $model
     * @throws CheckDataException
     */
    public function Check(ModelBase $model)
    {
        if (StringHelper::IsEmpty($model->f_id))
            throw new CheckDataException ('id不能为空');

        if (StringHelper::IsEmpty($model->f_client_id))
            throw new CheckDataException ('cid不能为空');

        if (StringHelper::IsEmpty($model->f_event_id))
            throw new CheckDataException ('eid不能为空');
    }
}
