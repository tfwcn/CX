<?php namespace App\Extended\Common\Exception;
use \Exception;

/**
 * 数据格式检查异常类
 */
class CheckDataException extends Exception {
	/**
	 * 初始化
	 */
	public function __construct($msg) {
		$this->message=$msg;
	}
}