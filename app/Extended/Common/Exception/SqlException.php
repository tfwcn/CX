<?php namespace App\Extended\Common\Exception;
use \Exception;

/**
 * 数据处理异常类
 */
class SqlException extends Exception {
	/**
	 * 初始化
	 */
	public function __construct($msg) {
		$this->message=$msg;
	}
}