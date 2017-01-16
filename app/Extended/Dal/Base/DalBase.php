<?php

namespace App\Extended\Dal\Base;

use App\Extended\Common\StringHelper;
use App\Extended\Model\Base\ModelBase;
use Illuminate\Support\Facades\DB;
use App\Extended\Common\Exception\SqlException;

abstract class DalBase
{
    protected $modelName;

    /**
     * 初始化
     */
    public function __construct($modelName)
    {
        $this->modelName = $modelName;
    }

    public function GetModel($f_id)
    {
        $modelName = $this->modelName;
        return $modelName::find($f_id);
    }

    public function Add(ModelBase $model)
    {
        $model->f_create_time = DalBase::GetServerDateTime();
        $model->f_version = 0;
        $model->save();
    }

    public function Update(ModelBase $model)
    {
        $modelName = $this->modelName;
        $oldTime = $model->f_update_time;
        $model->f_update_time = DalBase::GetServerDateTime();
        $model->f_version++;
        $affectedRows = $modelName::where('f_id', '=', $model->f_id)
            ->where('f_version', '=', ($model->f_version - 1))
            ->update($model->getAttributes());
        if ($affectedRows == 0) {
            $model->f_update_time = $oldTime;
            $model->f_version--;
            throw new SqlException('更新有误！');
        }
    }

    /**
     * @param $sql 查询语句
     * @param $pageIndex 页码，1开始
     * @param $pageSize 页数
     * @return mixed
     */
    public function GetPage($sql, $pageIndex, $pageSize)
    {
        if (StringHelper::IsEmpty($sql))
            throw new SqlException('分页语句为空！');
        if (StringHelper::IsNull($pageIndex) || $pageIndex < 1)
            $pageIndex = 1;
        if (StringHelper::IsNull($pageSize) || $pageSize < 1)
            $pageSize = 10;
        return DB::select("select * from () where bw_row between 1000000 and 1000010;");
    }

    public function Delete(ModelBase $model)
    {
        $model->delete();
    }

    // [start] 静态方法
    public static function GetServerDateTime()
    {
        $result = DB::select('select NOW() as datetime');
        return $result[0]->datetime;
    }

    /**
     * 打开事务，数据操作在function内执行
     * @param $fun
     */
    public static function Transaction($fun)
    {
        DB::transaction($fun);
    }

    /**
     * 提交事务
     */
    public static function TransactionBegin()
    {
        DB::beginTransaction();
    }

    /**
     * 提交事务
     */
    public static function TransactionCommit()
    {
        DB::commit();
    }

    /**
     * 回滚事务
     */
    public static function TransactionRollBack()
    {
        DB::rollback();
    }
    // [end]
}
