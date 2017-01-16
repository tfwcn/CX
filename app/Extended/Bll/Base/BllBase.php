<?php namespace App\Extended\Bll\Base;

use App\Extended\Dal\Base\DalBase;
use App\Extended\Model\Base\ModelBase;

abstract class BllBase {
	protected $dal;
	/**
	 * 初始化
	 */
	public function __construct($dalBase)
	{
		$this->dal=$dalBase;
	}
	public function GetModel($id)
	{
		return $this->dal->GetModel($id);
	}
	public function Add(ModelBase $model)
	{
		return $this->dal->Add($model);
	}
	public function Update(ModelBase $model)
	{
		return $this->dal->Update($model);
	}
	public function Delete(ModelBase $model)
	{
		return $this->dal->Delete($model);
	}
	//[start] 静态方法
	public static function GetServerDateTime()
	{
		return DalBase::GetServerDateTime();
	}
	//[end]
}
