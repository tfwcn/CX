<?php namespace App\Extended\Common\Exception;
use \Exception;
/**
 * 系统异常类
 */
class SystemException extends Exception {
	/**
	 * 初始化
	 */
	public function __construct($msg) {
		$this->message="系统错误：" .$msg;
	}
}